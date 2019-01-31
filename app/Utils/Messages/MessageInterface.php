<?php
declare(strict_types = 1);

namespace App\Utils\Messages;

interface MessageInterface
{
    public static function getText($category = null): string;
}
