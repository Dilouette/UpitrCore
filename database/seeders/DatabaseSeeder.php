<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(QuestionTypeSeeder::class);
        $this->call(JobWorkflowSeeder::class);
        $this->call(JobWorkflowStageSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(JobSettingSeeder::class);
        $this->call(JobQuestionSeeder::class);
        $this->call(JobQuestionOptionSeeder::class);
        $this->call(CandidateSeeder::class);
        $this->call(ApplicantSeeder::class);
        $this->call(ApplicantResponseSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(InterviewSeeder::class);
        $this->call(InterviewSectionSeeder::class);
        $this->call(InterviewQuestionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ApplicantInterviewSeeder::class);
        $this->call(ApplicantInterviewFeedbackSeeder::class);

        // $this->call(ApplicantAssesmentSeeder::class);
        // $this->call(AssesmentSeeder::class);
        // $this->call(AssesmentQuestionSeeder::class);
        // $this->call(AssesmentQuestionOptionSeeder::class);
        // $this->call(AssesmentResponseSeeder::class);
        // $this->call(BenefitTemplateSeeder::class);
        // $this->call(NoteSeeder::class);
    }
}