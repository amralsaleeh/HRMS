<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DefaultNotification extends Notification
{
    use Queueable;

    // Variables - Start //
    private $user_id;

    private $message;
    // Variables - End //

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function __construct($user_id, $message)
    {
        $this->user_id = $user_id;
        $this->message = $message;
    }

    public function toArray(object $notifiable): array
    {
        $user = User::find($this->user_id);

        return [
            'user' => $user->EmployeeFullName,
            'employee_id' => $user->employee_id,
            'image' => $user->profile_photo_url,
            'message' => $this->message,
        ];
    }
}
