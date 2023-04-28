<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderFlow extends Enum
{
    const Cancelled        =   0; //取消訂單
    const Unchecked        =   1; //資料審核中
    const Checked          =   2; //資料已審核, 預付款項未到帳
    const Prepaid_paided   =   3; //預付款項已到帳
    const Transfering      =   4; //出貨中
    const Installed        =   5; //已到府安裝完畢
    const Completed        =   6; //程序完成
    const BonusChecked     =   7; //獎金已結算
    const BonusTransfered  =   8; //獎金已發放
}

