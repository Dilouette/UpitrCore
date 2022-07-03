<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ActivityStatuses extends Enum implements LocalizedEnum
{
    const NotStarted =   0;
    const Ongoing =   1;
    const Completed = 2;
    const Cancelled = 3;
}
