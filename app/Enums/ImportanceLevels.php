<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ImportanceLevels extends Enum implements LocalizedEnum
{
    const LowPriority =   0;
    const MediumPriority =   1;
    const HighPriority = 2;
}
