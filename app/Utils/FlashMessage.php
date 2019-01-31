<?php

namespace App\Utils;

class FlashMessage
{
    const TYPE_SUCCESS = 'success';
    const TYPE_ERROR = 'error';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';

    const OK = '';
    const INFO = '';
    const WARNING = '';
    const ERROR = '';

    const ACTION_CLOSE_SESSION = 'close_session';
    const ACTION_REMOVE_USER = 'remove_user';

    /**
     * Method for set session flash message.
     * @param $type string
     * @param $title string
     * @param $text string
     * @return void
     */
    public static function set($type, $title, $text)
    {
        \Session::flash('flashMessage', [
            'type' => $type,
            'title' => $title,
            'text' => $text
        ]);
    }

    public static function info(string $text)
    {
        self::set(self::TYPE_INFO, self::INFO, $text);
    }

    public static function success(string $text)
    {
        self::set(self::TYPE_SUCCESS, self::OK, $text);
    }

    public static function warning(string $text)
    {
        self::set(self::TYPE_WARNING, self::WARNING, $text);
    }

    public static function error(string $text)
    {
        self::set(self::TYPE_ERROR, self::ERROR, $text);
    }
}
