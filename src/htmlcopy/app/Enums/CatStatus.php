<?php

/*
    0:募集中,
    10:募集一時停止,
    20:トライアル中,
    30:正式譲渡承認待ち,
    40:正式譲渡済み,
    999:削除
*/

/* TODO
(1) 999:削除は管理者ログインの時のみ表示するように調整

*/

namespace App\Enums;

enum CatStatus: int
{
    case KUBUN_0 = 0;
    case KUBUN_10 = 10;
    case KUBUN_20 = 20;
    case KUBUN_30 = 30;
    case KUBUN_40 = 40;
    case KUBUN_999 = 999;

    public function label(): string
    {
        return match($this) {
            self::KUBUN_0 => '募集中',
            self::KUBUN_10 => '募集一時停止',
            self::KUBUN_20 => 'トライアル中',
            self::KUBUN_30 => '正式譲渡承認待ち',
            self::KUBUN_40 => '正式譲渡済み',
            self::KUBUN_999 => '削除',
        };
    }
}