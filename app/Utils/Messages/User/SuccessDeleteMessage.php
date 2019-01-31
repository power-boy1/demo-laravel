<?php

namespace App\Utils\Messages\User;

use App\Utils\FlashMessage;
use App\Utils\Messages\MessageInterface;

final class SuccessDeleteMessage implements MessageInterface
{
    const TEXT = 'User has been deleted';

    public static function getText($category = null): string
    {
        return self::TEXT;
    }

    public static function initFlashMessage(string $category = null): void
    {
        FlashMessage::success(self::getText($category));
    }
}
