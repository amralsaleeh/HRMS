<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class DefaultNotification extends Notification
{
    use Queueable;

    // Variables - Start //
    public $message;
    // Variables - End //

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'user' => Auth::user()->EmployeeFullName,
            'image' => Auth::user()->profile_photo_url,
            'message' => $this->message,
        ];
    }
}
