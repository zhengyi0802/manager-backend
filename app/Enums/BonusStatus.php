<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BonusStatus extends Enum
{
    const Unchecked     =   1;  //未結算
    const Checked       =   2;  //已結算
    const Transfered    =   3; //已撥款
}
