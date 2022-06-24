<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(CompanySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(EducationLevelSeeder::class);
        $this->call(EmploymentTypeSeeder::class);
        $this->call(ExperienceLevelSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(PermissionGroupSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(JobFunctionSeeder::class);

        // $this->call(ActivitySeeder::class);
        // $this->call(ApplicantAssesmentSeeder::class);
        // $this->call(ApplicantEducationSeeder::class);
        // $this->call(ApplicantExperienceSeeder::class);
        // $this->call(ApplicantInterviewSeeder::class);
        // $this->call(ApplicantInterviewFeedbackSeeder::class);
        // $this->call(ApplicantResponseSeeder::class);
        // $this->call(AssesmentSeeder::class);
        // $this->call(AssesmentQuestionSeeder::class);
        // $this->call(AssesmentQuestionOptionSeeder::class);
        // $this->call(AssesmentResponseSeeder::class);
        // $this->call(BenefitTemplateSeeder::class);
        // $this->call(InterviewSeeder::class);
        // $this->call(InterviewSectionSeeder::class);
        // $this->call(InteviewQuestionSeeder::class);
        // $this->call(JobSeeder::class);
        // $this->call(JobApplicantSeeder::class);
        // $this->call(JobFunctionSeeder::class);
        // $this->call(JobQuestionSeeder::class);
        // $this->call(JobQuestionOptionSeeder::class);
        // $this->call(JobSettingSeeder::class);
        // $this->call(JobWorkflowSeeder::class);
        // $this->call(JobWorkflowStageSeeder::class);
        // $this->call(NoteSeeder::class);
        // $this->call(QuestionTypeSeeder::class);
    }
}