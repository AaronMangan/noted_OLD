<?php

namespace App\Services;

class NotificationServices
{
    public static function notice(string $type = 'info', string $message) {
        notify()
    }
}
