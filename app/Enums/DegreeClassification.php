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
    const SecondClass =   2;
    const ThirdClass = 3;
    const Pass = 3;
}
