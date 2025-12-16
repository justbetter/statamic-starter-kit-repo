<?php

namespace Tests\Unit\Form;

use JustBetter\StatamicStarterKit\Jobs\SendFormSubmissionEmailJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\Form;
use Statamic\Sites\Site;
use Tests\TestCase;

class SendFormSubmissionEmailTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_send_form_submission_emails(): void
    {
        Mail::fake();
        Mail::assertNothingSent();

        $form = Form::make('::test::');
        $form->title('Test');

        $form->email([
            'to' => '::justbetter::@justbetter.nl',
            'html' => 'mail/submission',
            'mailer' => 'array',
            'subject' => '::new-submission::',
            'markdown' => true,
            'email_content' => '{{ list }}',
        ]);

        $form->save();

        $submission = $form->makeSubmission();
        $submission->save();

        $site = new Site('::test::', ['locale' => 'null'], true);

        SendFormSubmissionEmailJob::dispatch($submission, $site, $form->email());

        Mail::assertSentCount(1);
    }
}
