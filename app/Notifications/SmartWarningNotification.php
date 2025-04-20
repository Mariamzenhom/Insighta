<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class SmartWarningNotification extends Notification
{
    use Queueable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];  // نستخدم الإشعار عن طريق الـ database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->data['message'], // الرسالة التحذيرية
        ];
    }
}

