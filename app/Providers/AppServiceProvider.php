<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
        return (new MailMessage)
            ->subject("Welcome to Mo's marketplace - Verify Your Email")
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Thank you for registering an account.')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $url);
    });
    }
}
