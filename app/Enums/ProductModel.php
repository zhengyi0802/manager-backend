<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductModel extends Enum
{
    const Model_75     =   1;  //75吋
    const Model_65     =   2;
    const Model_82     =   3;
    const Model_86     =   4;
    const Model_98     =   5;
    const Model_100    =   6;
}
