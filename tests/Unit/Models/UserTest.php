<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Notifications\PasswordReset;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_casts(): void
    {
        $user = User::factory()->create();

        $this->assertNotEmpty(
            $user->getCasts()
        );
    }

    #[Test]
    public function it_can_send_password_reset_notification(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $resetToken = 'test-reset-token-123';

        $user->sendPasswordResetNotification($resetToken);

        Notification::assertSentTo($user, PasswordReset::class);
    }
}
