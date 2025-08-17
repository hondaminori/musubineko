<?php

namespace App\Enums;

enum CatGender: int
{
    case KUBUN_0 = 0;
    case KUBUN_1 = 1;
    case KUBUN_99 = 99;

    public function label(): string
    {
        return match($this) {
            self::KUBUN_0 => 'オス',
            self::KUBUN_1 => 'メス',
            self::KUBUN_99 => '不明',
        };
    }
}
