<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const Administrator =   1;  //超級管理者
    const Manager       =   2;  //管理者
    const Accounter     =   3;  //操作員
    const Reseller      =   4;  //代理經銷商
    const Distrobuter   =   5;  //廣告商
    const Member        =   6;  //一般使用者
}
