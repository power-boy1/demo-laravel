<?php

namespace App\Utils\Messages\Role;

use App\Utils\FlashMessage;
use App\Utils\Messages\MessageInterface;

final class SuccessUpdateMessage implements MessageInterface
{
    const TEXT = 'Role successful updated.';

    public static function getText($category = null): string
    {
        return self::TEXT;
    }

    public static function initFlashMessage(string $category = null): void
    {
        FlashMessage::success(self::getText($category));
    }
}
