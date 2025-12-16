<?php

namespace JustBetter\StatamicStarterKit\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Statamic\Contracts\Forms\Submission;
use Statamic\Forms\Email;
use Statamic\Sites\Site;

class SendFormSubmissionEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $config
     */
    public function __construct(
        protected Submission $submission,
        protected Site $site,
        public array $config
    ) {}

    public function handle(): void
    {
        $this->setMailContent();

        /** @var string|null $mailer */
        $mailer = $this->config['mailer'] ?? null;
        Mail::mailer($mailer)
            ->send(new Email($this->submission, $this->config, $this->site));
    }

    protected function setMailContent(): void
    {
        $data = $this->submission->data();
        /** @var Collection<int, array<string, mixed>> $fields */
        $fields = $this->submission->fields();
        $fieldHandles = $fields->pluck('handle')->all();
        $variables = [];
        $list = '';
        foreach ($fieldHandles as $field) {
            /** @var array<string, mixed>|null $fieldData */
            $fieldData = $fields->firstWhere('handle', $field);
            /** @var string $display */
            $display = isset($fieldData['display']) && is_string($fieldData['display']) ? $fieldData['display'] : '';
            $value = $data[$field] ?? '';
            $list .= '<strong>'.$display.':</strong> ';
            $variableValues = '';

            if (is_array($value)) {
                /** @var array<int|string, mixed> $value */
                foreach ($value as $key => $item) {
                    if ($key > 0) {
                        $list .= ', ';
                        $variableValues .= ', ';
                    }
                    /** @var array<string, mixed>|string $item */
                    $label = '';
                    if (is_array($item) && isset($item['label'])) {
                        $labelValue = $item['label'];
                        $label = is_string($labelValue) ? $labelValue : '';
                    } elseif (is_string($item)) {
                        $label = $item;
                    }
                    $list .= $label;
                    $variableValues .= $label;
                }
            } else {
                if (is_string($value)) {
                    $list .= $value;
                    $variableValues .= $value;
                } elseif (is_object($value) && method_exists($value, 'label')) {
                    $labelValue = $value->label();
                    if (is_string($labelValue)) {
                        $list .= $labelValue;
                        $variableValues .= $labelValue;
                    }
                }
            }

            $list .= '<br>';
            /** @var string $field */
            $variables["{{ $field }}"] = $variableValues;
        }

        $variables['{{ list }}'] = $list;

        /** @var string $emailContent */
        $emailContent = isset($this->config['email_content']) && is_string($this->config['email_content']) ? $this->config['email_content'] : '';
        $text = strtr($emailContent, $variables);
        $this->config['email_content'] = $text;
    }
}
