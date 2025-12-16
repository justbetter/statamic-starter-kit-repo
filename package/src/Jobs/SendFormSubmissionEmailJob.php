<?php

namespace JustBetter\StatamicStarterKit\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Statamic\Contracts\Forms\Submission;
use Statamic\Forms\Email;
use Statamic\Sites\Site;

class SendFormSubmissionEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Submission $submission, protected Site $site, public array $config) {}

    public function handle(): void
    {
        $this->setMailContent();

        Mail::mailer($this->config['mailer'] ?? null)
            ->send(new Email($this->submission, $this->config, $this->site));
    }

    protected function setMailContent(): void
    {
        $data = $this->submission->data();
        $fields = $this->submission->fields();
        $fieldHandles = $fields?->pluck('handle') ?? [];
        $variables = [];
        $list = '';
        foreach ($fieldHandles as $field) {
            $display = $fields->firstWhere('handle', $field)['display'] ?? '';
            $value = $data[$field] ?? null ?? '';
            $list .= '<strong>'.($display).':</strong> ';
            $variableValues = '';

            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if ($key > 0) {
                        $list .= ', ';
                        $variableValues .= ', ';
                    }
                    $list .= $item['label'] ?? '';
                    $variableValues .= $item['label'] ?? '';
                }
            } else {
                if (is_string($value)) {
                    $list .= $value;
                    $variableValues .= $value;
                } elseif (gettype($value) === 'object') {
                    $list .= $value->label();
                    $variableValues .= $value->label();
                }
            }

            $list .= '<br>';
            $variables["{{ $field }}"] = $variableValues;
        }

        $variables['{{ list }}'] = $list;

        $text = strtr($this->config['email_content'] ?? '', $variables);
        $this->config['email_content'] = $text;
    }
}
