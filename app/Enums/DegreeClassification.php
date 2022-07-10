<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DegreeClassification extends Enum implements LocalizedEnum
{
    const FirstClass =   1;
    const SecondClassUpper =   2;
    const SecondClassLower =   3;
    const ThirdClass = 4;
    const Pass = 5;
}
