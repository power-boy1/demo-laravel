<?php

namespace App\Utils\Messages\Role;

use App\Utils\FlashMessage;
use App\Utils\Messages\MessageInterface;

final class HasUsersMessage implements MessageInterface
{
    const TEXT = 'Role has users.';

    public static function getText($category = null): string
    {
        return self::TEXT;
    }

    public static function initFlashMessage(string $category = null): void
    {
        FlashMessage::error(self::getText($category));
    }
}
