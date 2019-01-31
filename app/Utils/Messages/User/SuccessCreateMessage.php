<?php

namespace App\Utils\Messages\User;

use App\Utils\FlashMessage;
use App\Utils\Messages\MessageInterface;

final class SuccessCreateMessage implements MessageInterface
{
    const TEXT = 'User successful created.';

    public static function getText($category = null): string
    {
        return self::TEXT;
    }

    public static function initFlashMessage(string $category = null): void
    {
        FlashMessage::success(self::getText($category));
    }
}
