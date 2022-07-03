<?php

use App\Enums\ActivityTypes;
use App\Enums\ActivityStatuses;
use App\Enums\ImportanceLevels;
use App\Enums\ActivityRelations;
use App\Enums\DegreeClassification;

return [
    DegreeClassification::class => [
        DegreeClassification::FirstClass => 'First Class',
        DegreeClassification::SecondClass => 'Second Class',
        DegreeClassification::ThirdClass => 'Third Class',
        DegreeClassification::Pass => 'Pass',
    ],

    ActivityTypes::class => [
        ActivityTypes::Call => 'Call',
        ActivityTypes::Meeting => 'Meeting',
        ActivityTypes::Task => 'Task',
        ActivityTypes::Email => 'Email',
        ActivityTypes::Interview => 'Interview',
    ],

    ActivityRelations::class => [
        ActivityRelations::Candidate => 'Candidate',
        ActivityRelations::Vacancy => 'Vacancy',
    ],

    ImportanceLevels::class => [
        ImportanceLevels::LowPriority => 'Low Priority',
        ImportanceLevels::MediumPriority => 'Medium Priority',
        ImportanceLevels::HighPriority => 'High Priority',
    ],

    ActivityStatuses::class => [
        ActivityStatuses::NotStarted => 'Not Started',
        ActivityStatuses::Ongoing => 'Ongoing',
        ActivityStatuses::Completed => 'Completed',
        ActivityStatuses::Cancelled => 'Cancelled',
    ],
];
