<?php

namespace App\Enums;

enum MenuEnum: string
{
    case MAIN = 'main';
    case SHOW = 'show';
    case ABOUT = 'about';
    case NEWS = 'news';

    public function label(): string
    {
        return match ($this) {
            self::MAIN => __('settings.main'),
            self::SHOW => __('settings.show'),
            self::NEWS => __('settings.news'),
            self::ABOUT => __('settings.about'),
        };
    }
}
