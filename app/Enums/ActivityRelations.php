<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ActivityRelations extends Enum implements LocalizedEnum
{
    const Candidate =   0;
    const Application =   1;
    const Vacancy =   2;
}
