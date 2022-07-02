<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ActivityTypes extends Enum implements LocalizedEnum
{
    const Call =   0;
    const Meeting =   1;
    const Task = 2;
    const Email = 3;
    const Interview = 4;
}
