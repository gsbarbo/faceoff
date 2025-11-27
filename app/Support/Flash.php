<?php

namespace App\Support;

class Flash
{
    public static function success(string $message): void
    {
        self::message($message, 'success');
    }

    public static function message(string $message, string $level = 'info'): void
    {
        session()->push('alerts', [
            'message' => $message,
            'level' => $level,
        ]);
    }

    public static function error(string $message): void
    {
        self::message($message, 'error');
    }

    public static function warning(string $message): void
    {
        self::message($message, 'warning');
    }

    public static function info(string $message): void
    {
        self::message($message, 'info');
    }
}
