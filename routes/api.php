<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\CityJobsController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\IndustryController;
use App\Http\Controllers\Api\JobNotesController;
use App\Http\Controllers\Api\AssesmentController;
use App\Http\Controllers\Api\InterviewController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\JobSettingController;
use App\Http\Controllers\Api\RegionJobsController;
use App\Http\Controllers\Api\CountryJobsController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\JobFunctionController;
use App\Http\Controllers\Api\JobQuestionController;
use App\Http\Controllers\Api\JobWorkflowController;
use App\Http\Controllers\Api\CurrencyJobsController;
use App\Http\Controllers\Api\IndustryJobsController;
use App\Http\Controllers\Api\JobApplicantController;
use App\Http\Controllers\Api\QuestionTypeController;
use App\Http\Controllers\Api\RegionCitiesController;
use App\Http\Controllers\Api\JobActivitiesController;
use App\Http\Controllers\Api\JobAssesmentsController;
use App\Http\Controllers\Api\JobInterviewsController;
use App\Http\Controllers\Api\MiscellaneousController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CountryRegionsController;
use App\Http\Controllers\Api\DepartmentJobsController;
use App\Http\Controllers\Api\EducationLevelController;
use App\Http\Controllers\Api\EmploymentTypeController;
use App\Http\Controllers\Api\JobJobSettingsController;
use App\Http\Controllers\Api\BenefitTemplateController;
use App\Http\Controllers\Api\DepartmentUsersController;
use App\Http\Controllers\Api\ExperienceLevelController;
use App\Http\Controllers\Api\JobFunctionJobsController;
use App\Http\Controllers\Api\JobJobQuestionsController;
use App\Http\Controllers\Api\JobWorkflowJobsController;
use App\Http\Controllers\Api\DesignationUsersController;
use App\Http\Controllers\Api\InterviewSectionController;
use App\Http\Controllers\Api\InteviewQuestionController;
use App\Http\Controllers\Api\JobJobApplicantsController;
use App\Http\Controllers\Api\JobWorkflowStageController;
use App\Http\Controllers\Api\ApplicantResponseController;
use App\Http\Controllers\Api\AssesmentQuestionController;
use App\Http\Controllers\Api\AssesmentResponseController;
use App\Http\Controllers\Api\JobApplicantNotesController;
use App\Http\Controllers\Api\JobQuestionOptionController;
use App\Http\Controllers\Api\ApplicantAssesmentController;
use App\Http\Controllers\Api\ApplicantEducationController;
use App\Http\Controllers\Api\ApplicantInterviewController;
use App\Http\Controllers\Api\EducationLevelJobsController;
use App\Http\Controllers\Api\EmploymentTypeJobsController;
use App\Http\Controllers\Api\ApplicantExperienceController;
use App\Http\Controllers\Api\ExperienceLevelJobsController;
use App\Http\Controllers\Api\JobApplicantActivitiesController;
use App\Http\Controllers\Api\AssesmentQuestionOptionController;
use App\Http\Controllers\Api\QuestionTypeJobQuestionsController;
use App\Http\Controllers\Api\ApplicantInterviewFeedbackController;
use App\Http\Controllers\Api\InterviewInterviewSectionsController;
use App\Http\Controllers\Api\AssesmentAssesmentQuestionsController;
use App\Http\Controllers\Api\JobWorkflowJobWorkflowStagesController;
use App\Http\Controllers\Api\JobQuestionApplicantResponsesController;
use App\Http\Controllers\Api\JobQuestionJobQuestionOptionsController;
use App\Http\Controllers\Api\JobWorkflowStageJobApplicantsController;
use App\Http\Controllers\Api\JobApplicantApplicantResponsesController;
use App\Http\Controllers\Api\QuestionTypeAssesmentQuestionsController;
use App\Http\Controllers\Api\JobApplicantApplicantAssesmentsController;
use App\Http\Controllers\Api\JobApplicantApplicantEducationsController;
use App\Http\Controllers\Api\JobApplicantApplicantInterviewsController;
use App\Http\Controllers\Api\JobApplicantApplicantExperiencesController;
use App\Http\Controllers\Api\InterviewSectionInteviewQuestionsController;
use App\Http\Controllers\Api\AssesmentQuestionAssesmentResponsesController;
use App\Http\Controllers\Api\JobQuestionOptionApplicantResponsesController;
use App\Http\Controllers\Api\ApplicantAssesmentAssesmentResponsesController;
use App\Http\Controllers\Api\AssesmentQuestionAssesmentQuestionOptionsController;
use App\Http\Controllers\Api\AssesmentQuestionOptionAssesmentResponsesController;
use App\Http\Controllers\Api\InteviewQuestionApplicantInterviewFeedbacksController;
use App\Http\Controllers\Api\ApplicantInterviewApplicantInterviewFeedbacksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.v1.')->prefix('v1')->group(function () {

    //Authentication Routes
    Route::name('auth.')->prefix('authentication')->group(function () {
        Route::post('/signin', [AuthenticationController::class, 'signin'])->name('signin');
        Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot.password');
        Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset.password');
    });

    //Miscellaneous Routes
    Route::name('misc.')->prefix('miscellaneous')->group(function () {
        Route::get('/countries', [MiscellaneousController::class, 'countries'])->name('countries');
        Route::get('/regions/{country_id}', [MiscellaneousController::class, 'regions'])->name('regions');
        Route::get('/cities/{region_id}', [MiscellaneousController::class, 'cities'])->name('cities');
        Route::get('/currencies', [MiscellaneousController::class, 'currencies'])->name('currencies');
        Route::get('/designations', [MiscellaneousController::class, 'designations'])->name('designations');
        Route::get('/industries', [MiscellaneousController::class, 'industries'])->name('industries');
        Route::get('/education-levels', [MiscellaneousController::class, 'educationLevels'])->name('education-levels');
        Route::get('/employment-types', [MiscellaneousController::class, 'employmentTypes'])->name('employment-types');
        Route::get('/experience-levels', [MiscellaneousController::class, 'experienceLevels'])->name('experience-levels');
        Route::get('/job-functions', [MiscellaneousController::class, 'jobFunctions'])->name('job-functions');
    });


    Route::get('/activities', [ActivityController::class, 'index'])->name(
        'activities.index'
    );
    Route::post('/activities', [ActivityController::class, 'store'])->name(
        'activities.store'
    );
    Route::get('/activities/{activity}', [
        ActivityController::class,
        'show',
    ])->name('activities.show');
    Route::put('/activities/{activity}', [
        ActivityController::class,
        'update',
    ])->name('activities.update');
    Route::delete('/activities/{activity}', [
        ActivityController::class,
        'destroy',
    ])->name('activities.destroy');

    Route::get('/applicant-assesments', [
        ApplicantAssesmentController::class,
        'index',
    ])->name('applicant-assesments.index');
    Route::post('/applicant-assesments', [
        ApplicantAssesmentController::class,
        'store',
    ])->name('applicant-assesments.store');
    Route::get('/applicant-assesments/{applicantAssesment}', [
        ApplicantAssesmentController::class,
        'show',
    ])->name('applicant-assesments.show');
    Route::put('/applicant-assesments/{applicantAssesment}', [
        ApplicantAssesmentController::class,
        'update',
    ])->name('applicant-assesments.update');
    Route::delete('/applicant-assesments/{applicantAssesment}', [
        ApplicantAssesmentController::class,
        'destroy',
    ])->name('applicant-assesments.destroy');

    // ApplicantAssesment Assesment Responses
    Route::get(
        '/applicant-assesments/{applicantAssesment}/assesment-responses',
        [ApplicantAssesmentAssesmentResponsesController::class, 'index']
    )->name('applicant-assesments.assesment-responses.index');
    Route::post(
        '/applicant-assesments/{applicantAssesment}/assesment-responses',
        [ApplicantAssesmentAssesmentResponsesController::class, 'store']
    )->name('applicant-assesments.assesment-responses.store');

    Route::get('/applicant-educations', [
        ApplicantEducationController::class,
        'index',
    ])->name('applicant-educations.index');
    Route::post('/applicant-educations', [
        ApplicantEducationController::class,
        'store',
    ])->name('applicant-educations.store');
    Route::get('/applicant-educations/{applicantEducation}', [
        ApplicantEducationController::class,
        'show',
    ])->name('applicant-educations.show');
    Route::put('/applicant-educations/{applicantEducation}', [
        ApplicantEducationController::class,
        'update',
    ])->name('applicant-educations.update');
    Route::delete('/applicant-educations/{applicantEducation}', [
        ApplicantEducationController::class,
        'destroy',
    ])->name('applicant-educations.destroy');

    Route::get('/applicant-experiences', [
        ApplicantExperienceController::class,
        'index',
    ])->name('applicant-experiences.index');
    Route::post('/applicant-experiences', [
        ApplicantExperienceController::class,
        'store',
    ])->name('applicant-experiences.store');
    Route::get('/applicant-experiences/{applicantExperience}', [
        ApplicantExperienceController::class,
        'show',
    ])->name('applicant-experiences.show');
    Route::put('/applicant-experiences/{applicantExperience}', [
        ApplicantExperienceController::class,
        'update',
    ])->name('applicant-experiences.update');
    Route::delete('/applicant-experiences/{applicantExperience}', [
        ApplicantExperienceController::class,
        'destroy',
    ])->name('applicant-experiences.destroy');

    Route::get('/applicant-interviews', [
        ApplicantInterviewController::class,
        'index',
    ])->name('applicant-interviews.index');
    Route::post('/applicant-interviews', [
        ApplicantInterviewController::class,
        'store',
    ])->name('applicant-interviews.store');
    Route::get('/applicant-interviews/{applicantInterview}', [
        ApplicantInterviewController::class,
        'show',
    ])->name('applicant-interviews.show');
    Route::put('/applicant-interviews/{applicantInterview}', [
        ApplicantInterviewController::class,
        'update',
    ])->name('applicant-interviews.update');
    Route::delete('/applicant-interviews/{applicantInterview}', [
        ApplicantInterviewController::class,
        'destroy',
    ])->name('applicant-interviews.destroy');

    // ApplicantInterview Applicant Interview Feedbacks
    Route::get(
        '/applicant-interviews/{applicantInterview}/applicant-interview-feedbacks',
        [
            ApplicantInterviewApplicantInterviewFeedbacksController::class,
            'index',
        ]
    )->name('applicant-interviews.applicant-interview-feedbacks.index');
    Route::post(
        '/applicant-interviews/{applicantInterview}/applicant-interview-feedbacks',
        [
            ApplicantInterviewApplicantInterviewFeedbacksController::class,
            'store',
        ]
    )->name('applicant-interviews.applicant-interview-feedbacks.store');

    Route::get('/applicant-interview-feedbacks', [
        ApplicantInterviewFeedbackController::class,
        'index',
    ])->name('applicant-interview-feedbacks.index');
    Route::post('/applicant-interview-feedbacks', [
        ApplicantInterviewFeedbackController::class,
        'store',
    ])->name('applicant-interview-feedbacks.store');
    Route::get('/applicant-interview-feedbacks/{applicantInterviewFeedback}', [
        ApplicantInterviewFeedbackController::class,
        'show',
    ])->name('applicant-interview-feedbacks.show');
    Route::put('/applicant-interview-feedbacks/{applicantInterviewFeedback}', [
        ApplicantInterviewFeedbackController::class,
        'update',
    ])->name('applicant-interview-feedbacks.update');
    Route::delete(
        '/applicant-interview-feedbacks/{applicantInterviewFeedback}',
        [ApplicantInterviewFeedbackController::class, 'destroy']
    )->name('applicant-interview-feedbacks.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name(
        'users.store'
    );
    Route::get('/users/{user}', [UserController::class, 'show'])->name(
        'users.show'
    );
    Route::put('/users/{user}', [UserController::class, 'update'])->name(
        'users.update'
    );
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name(
        'users.destroy'
    );

    Route::get('/regions', [RegionController::class, 'index'])->name(
        'regions.index'
    );
    Route::post('/regions', [RegionController::class, 'store'])->name(
        'regions.store'
    );
    Route::get('/regions/{region}', [RegionController::class, 'show'])->name(
        'regions.show'
    );
    Route::put('/regions/{region}', [RegionController::class, 'update'])->name(
        'regions.update'
    );
    Route::delete('/regions/{region}', [
        RegionController::class,
        'destroy',
    ])->name('regions.destroy');

    // Region Cities
    Route::get('/regions/{region}/cities', [
        RegionCitiesController::class,
        'index',
    ])->name('regions.cities.index');
    Route::post('/regions/{region}/cities', [
        RegionCitiesController::class,
        'store',
    ])->name('regions.cities.store');

    // Region Jobs
    Route::get('/regions/{region}/jobs', [
        RegionJobsController::class,
        'index',
    ])->name('regions.jobs.index');
    Route::post('/regions/{region}/jobs', [
        RegionJobsController::class,
        'store',
    ])->name('regions.jobs.store');

    Route::get('/question-types', [
        QuestionTypeController::class,
        'index',
    ])->name('question-types.index');
    Route::post('/question-types', [
        QuestionTypeController::class,
        'store',
    ])->name('question-types.store');
    Route::get('/question-types/{questionType}', [
        QuestionTypeController::class,
        'show',
    ])->name('question-types.show');
    Route::put('/question-types/{questionType}', [
        QuestionTypeController::class,
        'update',
    ])->name('question-types.update');
    Route::delete('/question-types/{questionType}', [
        QuestionTypeController::class,
        'destroy',
    ])->name('question-types.destroy');

    // QuestionType Job Questions
    Route::get('/question-types/{questionType}/job-questions', [
        QuestionTypeJobQuestionsController::class,
        'index',
    ])->name('question-types.job-questions.index');
    Route::post('/question-types/{questionType}/job-questions', [
        QuestionTypeJobQuestionsController::class,
        'store',
    ])->name('question-types.job-questions.store');

    // QuestionType Assesment Questions
    Route::get('/question-types/{questionType}/assesment-questions', [
        QuestionTypeAssesmentQuestionsController::class,
        'index',
    ])->name('question-types.assesment-questions.index');
    Route::post('/question-types/{questionType}/assesment-questions', [
        QuestionTypeAssesmentQuestionsController::class,
        'store',
    ])->name('question-types.assesment-questions.store');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/notes', [NoteController::class, 'store'])->name(
        'notes.store'
    );
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name(
        'notes.show'
    );
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name(
        'notes.update'
    );
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name(
        'notes.destroy'
    );

    Route::get('/job-workflow-stages', [
        JobWorkflowStageController::class,
        'index',
    ])->name('job-workflow-stages.index');
    Route::post('/job-workflow-stages', [
        JobWorkflowStageController::class,
        'store',
    ])->name('job-workflow-stages.store');
    Route::get('/job-workflow-stages/{jobWorkflowStage}', [
        JobWorkflowStageController::class,
        'show',
    ])->name('job-workflow-stages.show');
    Route::put('/job-workflow-stages/{jobWorkflowStage}', [
        JobWorkflowStageController::class,
        'update',
    ])->name('job-workflow-stages.update');
    Route::delete('/job-workflow-stages/{jobWorkflowStage}', [
        JobWorkflowStageController::class,
        'destroy',
    ])->name('job-workflow-stages.destroy');

    // JobWorkflowStage Job Applicants
    Route::get('/job-workflow-stages/{jobWorkflowStage}/job-applicants', [
        JobWorkflowStageJobApplicantsController::class,
        'index',
    ])->name('job-workflow-stages.job-applicants.index');
    Route::post('/job-workflow-stages/{jobWorkflowStage}/job-applicants', [
        JobWorkflowStageJobApplicantsController::class,
        'store',
    ])->name('job-workflow-stages.job-applicants.store');

    Route::get('/job-workflows', [JobWorkflowController::class, 'index'])->name(
        'job-workflows.index'
    );
    Route::post('/job-workflows', [
        JobWorkflowController::class,
        'store',
    ])->name('job-workflows.store');
    Route::get('/job-workflows/{jobWorkflow}', [
        JobWorkflowController::class,
        'show',
    ])->name('job-workflows.show');
    Route::put('/job-workflows/{jobWorkflow}', [
        JobWorkflowController::class,
        'update',
    ])->name('job-workflows.update');
    Route::delete('/job-workflows/{jobWorkflow}', [
        JobWorkflowController::class,
        'destroy',
    ])->name('job-workflows.destroy');

    // JobWorkflow Jobs
    Route::get('/job-workflows/{jobWorkflow}/jobs', [
        JobWorkflowJobsController::class,
        'index',
    ])->name('job-workflows.jobs.index');
    Route::post('/job-workflows/{jobWorkflow}/jobs', [
        JobWorkflowJobsController::class,
        'store',
    ])->name('job-workflows.jobs.store');

    // JobWorkflow Job Workflow Stages
    Route::get('/job-workflows/{jobWorkflow}/job-workflow-stages', [
        JobWorkflowJobWorkflowStagesController::class,
        'index',
    ])->name('job-workflows.job-workflow-stages.index');
    Route::post('/job-workflows/{jobWorkflow}/job-workflow-stages', [
        JobWorkflowJobWorkflowStagesController::class,
        'store',
    ])->name('job-workflows.job-workflow-stages.store');

    Route::get('/job-settings', [JobSettingController::class, 'index'])->name(
        'job-settings.index'
    );
    Route::post('/job-settings', [JobSettingController::class, 'store'])->name(
        'job-settings.store'
    );
    Route::get('/job-settings/{jobSetting}', [
        JobSettingController::class,
        'show',
    ])->name('job-settings.show');
    Route::put('/job-settings/{jobSetting}', [
        JobSettingController::class,
        'update',
    ])->name('job-settings.update');
    Route::delete('/job-settings/{jobSetting}', [
        JobSettingController::class,
        'destroy',
    ])->name('job-settings.destroy');

    Route::get('/job-question-options', [
        JobQuestionOptionController::class,
        'index',
    ])->name('job-question-options.index');
    Route::post('/job-question-options', [
        JobQuestionOptionController::class,
        'store',
    ])->name('job-question-options.store');
    Route::get('/job-question-options/{jobQuestionOption}', [
        JobQuestionOptionController::class,
        'show',
    ])->name('job-question-options.show');
    Route::put('/job-question-options/{jobQuestionOption}', [
        JobQuestionOptionController::class,
        'update',
    ])->name('job-question-options.update');
    Route::delete('/job-question-options/{jobQuestionOption}', [
        JobQuestionOptionController::class,
        'destroy',
    ])->name('job-question-options.destroy');

    // JobQuestionOption Applicant Responses
    Route::get(
        '/job-question-options/{jobQuestionOption}/applicant-responses',
        [JobQuestionOptionApplicantResponsesController::class, 'index']
    )->name('job-question-options.applicant-responses.index');
    Route::post(
        '/job-question-options/{jobQuestionOption}/applicant-responses',
        [JobQuestionOptionApplicantResponsesController::class, 'store']
    )->name('job-question-options.applicant-responses.store');

    Route::get('/job-questions', [JobQuestionController::class, 'index'])->name(
        'job-questions.index'
    );
    Route::post('/job-questions', [
        JobQuestionController::class,
        'store',
    ])->name('job-questions.store');
    Route::get('/job-questions/{jobQuestion}', [
        JobQuestionController::class,
        'show',
    ])->name('job-questions.show');
    Route::put('/job-questions/{jobQuestion}', [
        JobQuestionController::class,
        'update',
    ])->name('job-questions.update');
    Route::delete('/job-questions/{jobQuestion}', [
        JobQuestionController::class,
        'destroy',
    ])->name('job-questions.destroy');

    // JobQuestion Job Question Options
    Route::get('/job-questions/{jobQuestion}/job-question-options', [
        JobQuestionJobQuestionOptionsController::class,
        'index',
    ])->name('job-questions.job-question-options.index');
    Route::post('/job-questions/{jobQuestion}/job-question-options', [
        JobQuestionJobQuestionOptionsController::class,
        'store',
    ])->name('job-questions.job-question-options.store');

    // JobQuestion Applicant Responses
    Route::get('/job-questions/{jobQuestion}/applicant-responses', [
        JobQuestionApplicantResponsesController::class,
        'index',
    ])->name('job-questions.applicant-responses.index');
    Route::post('/job-questions/{jobQuestion}/applicant-responses', [
        JobQuestionApplicantResponsesController::class,
        'store',
    ])->name('job-questions.applicant-responses.store');

    Route::get('/job-functions', [JobFunctionController::class, 'index'])->name(
        'job-functions.index'
    );
    Route::post('/job-functions', [
        JobFunctionController::class,
        'store',
    ])->name('job-functions.store');
    Route::get('/job-functions/{jobFunction}', [
        JobFunctionController::class,
        'show',
    ])->name('job-functions.show');
    Route::put('/job-functions/{jobFunction}', [
        JobFunctionController::class,
        'update',
    ])->name('job-functions.update');
    Route::delete('/job-functions/{jobFunction}', [
        JobFunctionController::class,
        'destroy',
    ])->name('job-functions.destroy');

    // JobFunction Jobs
    Route::get('/job-functions/{jobFunction}/jobs', [
        JobFunctionJobsController::class,
        'index',
    ])->name('job-functions.jobs.index');
    Route::post('/job-functions/{jobFunction}/jobs', [
        JobFunctionJobsController::class,
        'store',
    ])->name('job-functions.jobs.store');

    Route::get('/job-applicants', [
        JobApplicantController::class,
        'index',
    ])->name('job-applicants.index');
    Route::post('/job-applicants', [
        JobApplicantController::class,
        'store',
    ])->name('job-applicants.store');
    Route::get('/job-applicants/{jobApplicant}', [
        JobApplicantController::class,
        'show',
    ])->name('job-applicants.show');
    Route::put('/job-applicants/{jobApplicant}', [
        JobApplicantController::class,
        'update',
    ])->name('job-applicants.update');
    Route::delete('/job-applicants/{jobApplicant}', [
        JobApplicantController::class,
        'destroy',
    ])->name('job-applicants.destroy');

    // JobApplicant Applicant Experiences
    Route::get('/job-applicants/{jobApplicant}/applicant-experiences', [
        JobApplicantApplicantExperiencesController::class,
        'index',
    ])->name('job-applicants.applicant-experiences.index');
    Route::post('/job-applicants/{jobApplicant}/applicant-experiences', [
        JobApplicantApplicantExperiencesController::class,
        'store',
    ])->name('job-applicants.applicant-experiences.store');

    // JobApplicant Applicant Educations
    Route::get('/job-applicants/{jobApplicant}/applicant-educations', [
        JobApplicantApplicantEducationsController::class,
        'index',
    ])->name('job-applicants.applicant-educations.index');
    Route::post('/job-applicants/{jobApplicant}/applicant-educations', [
        JobApplicantApplicantEducationsController::class,
        'store',
    ])->name('job-applicants.applicant-educations.store');

    // JobApplicant Applicant Responses
    Route::get('/job-applicants/{jobApplicant}/applicant-responses', [
        JobApplicantApplicantResponsesController::class,
        'index',
    ])->name('job-applicants.applicant-responses.index');
    Route::post('/job-applicants/{jobApplicant}/applicant-responses', [
        JobApplicantApplicantResponsesController::class,
        'store',
    ])->name('job-applicants.applicant-responses.store');

    // JobApplicant Applicant Assesments
    Route::get('/job-applicants/{jobApplicant}/applicant-assesments', [
        JobApplicantApplicantAssesmentsController::class,
        'index',
    ])->name('job-applicants.applicant-assesments.index');
    Route::post('/job-applicants/{jobApplicant}/applicant-assesments', [
        JobApplicantApplicantAssesmentsController::class,
        'store',
    ])->name('job-applicants.applicant-assesments.store');

    // JobApplicant Applicant Interviews
    Route::get('/job-applicants/{jobApplicant}/applicant-interviews', [
        JobApplicantApplicantInterviewsController::class,
        'index',
    ])->name('job-applicants.applicant-interviews.index');
    Route::post('/job-applicants/{jobApplicant}/applicant-interviews', [
        JobApplicantApplicantInterviewsController::class,
        'store',
    ])->name('job-applicants.applicant-interviews.store');

    // JobApplicant Activities
    Route::get('/job-applicants/{jobApplicant}/activities', [
        JobApplicantActivitiesController::class,
        'index',
    ])->name('job-applicants.activities.index');
    Route::post('/job-applicants/{jobApplicant}/activities', [
        JobApplicantActivitiesController::class,
        'store',
    ])->name('job-applicants.activities.store');

    // JobApplicant Notes
    Route::get('/job-applicants/{jobApplicant}/notes', [
        JobApplicantNotesController::class,
        'index',
    ])->name('job-applicants.notes.index');
    Route::post('/job-applicants/{jobApplicant}/notes', [
        JobApplicantNotesController::class,
        'store',
    ])->name('job-applicants.notes.store');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name(
        'jobs.show'
    );
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name(
        'jobs.update'
    );
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name(
        'jobs.destroy'
    );

    // Job Applications
    Route::get('/jobs/{job}/job-applicants', [
        JobJobApplicantsController::class,
        'index',
    ])->name('jobs.job-applicants.index');
    Route::post('/jobs/{job}/job-applicants', [
        JobJobApplicantsController::class,
        'store',
    ])->name('jobs.job-applicants.store');

    // Job Job Questions
    Route::get('/jobs/{job}/job-questions', [
        JobJobQuestionsController::class,
        'index',
    ])->name('jobs.job-questions.index');
    Route::post('/jobs/{job}/job-questions', [
        JobJobQuestionsController::class,
        'store',
    ])->name('jobs.job-questions.store');

    // Job Job Settings
    Route::get('/jobs/{job}/job-settings', [
        JobJobSettingsController::class,
        'index',
    ])->name('jobs.job-settings.index');
    Route::post('/jobs/{job}/job-settings', [
        JobJobSettingsController::class,
        'store',
    ])->name('jobs.job-settings.store');

    // Job Assesments
    Route::get('/jobs/{job}/assesments', [
        JobAssesmentsController::class,
        'index',
    ])->name('jobs.assesments.index');
    Route::post('/jobs/{job}/assesments', [
        JobAssesmentsController::class,
        'store',
    ])->name('jobs.assesments.store');

    // Job Interviews
    Route::get('/jobs/{job}/interviews', [
        JobInterviewsController::class,
        'index',
    ])->name('jobs.interviews.index');
    Route::post('/jobs/{job}/interviews', [
        JobInterviewsController::class,
        'store',
    ])->name('jobs.interviews.store');

    // Job Activities
    Route::get('/jobs/{job}/activities', [
        JobActivitiesController::class,
        'index',
    ])->name('jobs.activities.index');
    Route::post('/jobs/{job}/activities', [
        JobActivitiesController::class,
        'store',
    ])->name('jobs.activities.store');

    // Job Notes
    Route::get('/jobs/{job}/notes', [JobNotesController::class, 'index'])->name(
        'jobs.notes.index'
    );
    Route::post('/jobs/{job}/notes', [
        JobNotesController::class,
        'store',
    ])->name('jobs.notes.store');

    Route::get('/inteview-questions', [
        InteviewQuestionController::class,
        'index',
    ])->name('inteview-questions.index');
    Route::post('/inteview-questions', [
        InteviewQuestionController::class,
        'store',
    ])->name('inteview-questions.store');
    Route::get('/inteview-questions/{inteviewQuestion}', [
        InteviewQuestionController::class,
        'show',
    ])->name('inteview-questions.show');
    Route::put('/inteview-questions/{inteviewQuestion}', [
        InteviewQuestionController::class,
        'update',
    ])->name('inteview-questions.update');
    Route::delete('/inteview-questions/{inteviewQuestion}', [
        InteviewQuestionController::class,
        'destroy',
    ])->name('inteview-questions.destroy');

    // InteviewQuestion Applicant Interview Feedbacks
    Route::get(
        '/inteview-questions/{inteviewQuestion}/applicant-interview-feedbacks',
        [InteviewQuestionApplicantInterviewFeedbacksController::class, 'index']
    )->name('inteview-questions.applicant-interview-feedbacks.index');
    Route::post(
        '/inteview-questions/{inteviewQuestion}/applicant-interview-feedbacks',
        [InteviewQuestionApplicantInterviewFeedbacksController::class, 'store']
    )->name('inteview-questions.applicant-interview-feedbacks.store');

    Route::get('/interview-sections', [
        InterviewSectionController::class,
        'index',
    ])->name('interview-sections.index');
    Route::post('/interview-sections', [
        InterviewSectionController::class,
        'store',
    ])->name('interview-sections.store');
    Route::get('/interview-sections/{interviewSection}', [
        InterviewSectionController::class,
        'show',
    ])->name('interview-sections.show');
    Route::put('/interview-sections/{interviewSection}', [
        InterviewSectionController::class,
        'update',
    ])->name('interview-sections.update');
    Route::delete('/interview-sections/{interviewSection}', [
        InterviewSectionController::class,
        'destroy',
    ])->name('interview-sections.destroy');

    // InterviewSection Inteview Questions
    Route::get('/interview-sections/{interviewSection}/inteview-questions', [
        InterviewSectionInteviewQuestionsController::class,
        'index',
    ])->name('interview-sections.inteview-questions.index');
    Route::post('/interview-sections/{interviewSection}/inteview-questions', [
        InterviewSectionInteviewQuestionsController::class,
        'store',
    ])->name('interview-sections.inteview-questions.store');

    Route::get('/interviews', [InterviewController::class, 'index'])->name(
        'interviews.index'
    );
    Route::post('/interviews', [InterviewController::class, 'store'])->name(
        'interviews.store'
    );
    Route::get('/interviews/{interview}', [
        InterviewController::class,
        'show',
    ])->name('interviews.show');
    Route::put('/interviews/{interview}', [
        InterviewController::class,
        'update',
    ])->name('interviews.update');
    Route::delete('/interviews/{interview}', [
        InterviewController::class,
        'destroy',
    ])->name('interviews.destroy');

    // Interview Interview Sections
    Route::get('/interviews/{interview}/interview-sections', [
        InterviewInterviewSectionsController::class,
        'index',
    ])->name('interviews.interview-sections.index');
    Route::post('/interviews/{interview}/interview-sections', [
        InterviewInterviewSectionsController::class,
        'store',
    ])->name('interviews.interview-sections.store');

    Route::get('/industries', [IndustryController::class, 'index'])->name(
        'industries.index'
    );
    Route::post('/industries', [IndustryController::class, 'store'])->name(
        'industries.store'
    );
    Route::get('/industries/{industry}', [
        IndustryController::class,
        'show',
    ])->name('industries.show');
    Route::put('/industries/{industry}', [
        IndustryController::class,
        'update',
    ])->name('industries.update');
    Route::delete('/industries/{industry}', [
        IndustryController::class,
        'destroy',
    ])->name('industries.destroy');

    // Industry Jobs
    Route::get('/industries/{industry}/jobs', [
        IndustryJobsController::class,
        'index',
    ])->name('industries.jobs.index');
    Route::post('/industries/{industry}/jobs', [
        IndustryJobsController::class,
        'store',
    ])->name('industries.jobs.store');

    Route::get('/experience-levels', [
        ExperienceLevelController::class,
        'index',
    ])->name('experience-levels.index');
    Route::post('/experience-levels', [
        ExperienceLevelController::class,
        'store',
    ])->name('experience-levels.store');
    Route::get('/experience-levels/{experienceLevel}', [
        ExperienceLevelController::class,
        'show',
    ])->name('experience-levels.show');
    Route::put('/experience-levels/{experienceLevel}', [
        ExperienceLevelController::class,
        'update',
    ])->name('experience-levels.update');
    Route::delete('/experience-levels/{experienceLevel}', [
        ExperienceLevelController::class,
        'destroy',
    ])->name('experience-levels.destroy');

    // ExperienceLevel Jobs
    Route::get('/experience-levels/{experienceLevel}/jobs', [
        ExperienceLevelJobsController::class,
        'index',
    ])->name('experience-levels.jobs.index');
    Route::post('/experience-levels/{experienceLevel}/jobs', [
        ExperienceLevelJobsController::class,
        'store',
    ])->name('experience-levels.jobs.store');

    Route::get('/employment-types', [
        EmploymentTypeController::class,
        'index',
    ])->name('employment-types.index');
    Route::post('/employment-types', [
        EmploymentTypeController::class,
        'store',
    ])->name('employment-types.store');
    Route::get('/employment-types/{employmentType}', [
        EmploymentTypeController::class,
        'show',
    ])->name('employment-types.show');
    Route::put('/employment-types/{employmentType}', [
        EmploymentTypeController::class,
        'update',
    ])->name('employment-types.update');
    Route::delete('/employment-types/{employmentType}', [
        EmploymentTypeController::class,
        'destroy',
    ])->name('employment-types.destroy');

    // EmploymentType Jobs
    Route::get('/employment-types/{employmentType}/jobs', [
        EmploymentTypeJobsController::class,
        'index',
    ])->name('employment-types.jobs.index');
    Route::post('/employment-types/{employmentType}/jobs', [
        EmploymentTypeJobsController::class,
        'store',
    ])->name('employment-types.jobs.store');

    Route::get('/education-levels', [
        EducationLevelController::class,
        'index',
    ])->name('education-levels.index');
    Route::post('/education-levels', [
        EducationLevelController::class,
        'store',
    ])->name('education-levels.store');
    Route::get('/education-levels/{educationLevel}', [
        EducationLevelController::class,
        'show',
    ])->name('education-levels.show');
    Route::put('/education-levels/{educationLevel}', [
        EducationLevelController::class,
        'update',
    ])->name('education-levels.update');
    Route::delete('/education-levels/{educationLevel}', [
        EducationLevelController::class,
        'destroy',
    ])->name('education-levels.destroy');

    // EducationLevel Jobs
    Route::get('/education-levels/{educationLevel}/jobs', [
        EducationLevelJobsController::class,
        'index',
    ])->name('education-levels.jobs.index');
    Route::post('/education-levels/{educationLevel}/jobs', [
        EducationLevelJobsController::class,
        'store',
    ])->name('education-levels.jobs.store');

    Route::get('/applicant-responses', [
        ApplicantResponseController::class,
        'index',
    ])->name('applicant-responses.index');
    Route::post('/applicant-responses', [
        ApplicantResponseController::class,
        'store',
    ])->name('applicant-responses.store');
    Route::get('/applicant-responses/{applicantResponse}', [
        ApplicantResponseController::class,
        'show',
    ])->name('applicant-responses.show');
    Route::put('/applicant-responses/{applicantResponse}', [
        ApplicantResponseController::class,
        'update',
    ])->name('applicant-responses.update');
    Route::delete('/applicant-responses/{applicantResponse}', [
        ApplicantResponseController::class,
        'destroy',
    ])->name('applicant-responses.destroy');

    Route::get('/assesments', [AssesmentController::class, 'index'])->name(
        'assesments.index'
    );
    Route::post('/assesments', [AssesmentController::class, 'store'])->name(
        'assesments.store'
    );
    Route::get('/assesments/{assesment}', [
        AssesmentController::class,
        'show',
    ])->name('assesments.show');
    Route::put('/assesments/{assesment}', [
        AssesmentController::class,
        'update',
    ])->name('assesments.update');
    Route::delete('/assesments/{assesment}', [
        AssesmentController::class,
        'destroy',
    ])->name('assesments.destroy');

    // Assesment Assesment Questions
    Route::get('/assesments/{assesment}/assesment-questions', [
        AssesmentAssesmentQuestionsController::class,
        'index',
    ])->name('assesments.assesment-questions.index');
    Route::post('/assesments/{assesment}/assesment-questions', [
        AssesmentAssesmentQuestionsController::class,
        'store',
    ])->name('assesments.assesment-questions.store');

    Route::get('/assesment-questions', [
        AssesmentQuestionController::class,
        'index',
    ])->name('assesment-questions.index');
    Route::post('/assesment-questions', [
        AssesmentQuestionController::class,
        'store',
    ])->name('assesment-questions.store');
    Route::get('/assesment-questions/{assesmentQuestion}', [
        AssesmentQuestionController::class,
        'show',
    ])->name('assesment-questions.show');
    Route::put('/assesment-questions/{assesmentQuestion}', [
        AssesmentQuestionController::class,
        'update',
    ])->name('assesment-questions.update');
    Route::delete('/assesment-questions/{assesmentQuestion}', [
        AssesmentQuestionController::class,
        'destroy',
    ])->name('assesment-questions.destroy');

    // AssesmentQuestion Assesment Question Options
    Route::get(
        '/assesment-questions/{assesmentQuestion}/assesment-question-options',
        [AssesmentQuestionAssesmentQuestionOptionsController::class, 'index']
    )->name('assesment-questions.assesment-question-options.index');
    Route::post(
        '/assesment-questions/{assesmentQuestion}/assesment-question-options',
        [AssesmentQuestionAssesmentQuestionOptionsController::class, 'store']
    )->name('assesment-questions.assesment-question-options.store');

    // AssesmentQuestion Assesment Responses
    Route::get('/assesment-questions/{assesmentQuestion}/assesment-responses', [
        AssesmentQuestionAssesmentResponsesController::class,
        'index',
    ])->name('assesment-questions.assesment-responses.index');
    Route::post(
        '/assesment-questions/{assesmentQuestion}/assesment-responses',
        [AssesmentQuestionAssesmentResponsesController::class, 'store']
    )->name('assesment-questions.assesment-responses.store');

    Route::get('/assesment-question-options', [
        AssesmentQuestionOptionController::class,
        'index',
    ])->name('assesment-question-options.index');
    Route::post('/assesment-question-options', [
        AssesmentQuestionOptionController::class,
        'store',
    ])->name('assesment-question-options.store');
    Route::get('/assesment-question-options/{assesmentQuestionOption}', [
        AssesmentQuestionOptionController::class,
        'show',
    ])->name('assesment-question-options.show');
    Route::put('/assesment-question-options/{assesmentQuestionOption}', [
        AssesmentQuestionOptionController::class,
        'update',
    ])->name('assesment-question-options.update');
    Route::delete('/assesment-question-options/{assesmentQuestionOption}', [
        AssesmentQuestionOptionController::class,
        'destroy',
    ])->name('assesment-question-options.destroy');

    // AssesmentQuestionOption Assesment Responses
    Route::get(
        '/assesment-question-options/{assesmentQuestionOption}/assesment-responses',
        [AssesmentQuestionOptionAssesmentResponsesController::class, 'index']
    )->name('assesment-question-options.assesment-responses.index');
    Route::post(
        '/assesment-question-options/{assesmentQuestionOption}/assesment-responses',
        [AssesmentQuestionOptionAssesmentResponsesController::class, 'store']
    )->name('assesment-question-options.assesment-responses.store');

    Route::get('/assesment-responses', [
        AssesmentResponseController::class,
        'index',
    ])->name('assesment-responses.index');
    Route::post('/assesment-responses', [
        AssesmentResponseController::class,
        'store',
    ])->name('assesment-responses.store');
    Route::get('/assesment-responses/{assesmentResponse}', [
        AssesmentResponseController::class,
        'show',
    ])->name('assesment-responses.show');
    Route::put('/assesment-responses/{assesmentResponse}', [
        AssesmentResponseController::class,
        'update',
    ])->name('assesment-responses.update');
    Route::delete('/assesment-responses/{assesmentResponse}', [
        AssesmentResponseController::class,
        'destroy',
    ])->name('assesment-responses.destroy');

    Route::get('/benefit-templates', [
        BenefitTemplateController::class,
        'index',
    ])->name('benefit-templates.index');
    Route::post('/benefit-templates', [
        BenefitTemplateController::class,
        'store',
    ])->name('benefit-templates.store');
    Route::get('/benefit-templates/{benefitTemplate}', [
        BenefitTemplateController::class,
        'show',
    ])->name('benefit-templates.show');
    Route::put('/benefit-templates/{benefitTemplate}', [
        BenefitTemplateController::class,
        'update',
    ])->name('benefit-templates.update');
    Route::delete('/benefit-templates/{benefitTemplate}', [
        BenefitTemplateController::class,
        'destroy',
    ])->name('benefit-templates.destroy');

    Route::get('/cities', [CityController::class, 'index'])->name(
        'cities.index'
    );
    Route::post('/cities', [CityController::class, 'store'])->name(
        'cities.store'
    );
    Route::get('/cities/{city}', [CityController::class, 'show'])->name(
        'cities.show'
    );
    Route::put('/cities/{city}', [CityController::class, 'update'])->name(
        'cities.update'
    );
    Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name(
        'cities.destroy'
    );

    // City Jobs
    Route::get('/cities/{city}/jobs', [
        CityJobsController::class,
        'index',
    ])->name('cities.jobs.index');
    Route::post('/cities/{city}/jobs', [
        CityJobsController::class,
        'store',
    ])->name('cities.jobs.store');

    Route::get('/companies', [CompanyController::class, 'index'])->name(
        'companies.index'
    );
    Route::post('/companies', [CompanyController::class, 'store'])->name(
        'companies.store'
    );
    Route::get('/companies/{company}', [
        CompanyController::class,
        'show',
    ])->name('companies.show');
    Route::put('/companies/{company}', [
        CompanyController::class,
        'update',
    ])->name('companies.update');
    Route::delete('/companies/{company}', [
        CompanyController::class,
        'destroy',
    ])->name('companies.destroy');

    Route::get('/countries', [CountryController::class, 'index'])->name(
        'countries.index'
    );
    Route::post('/countries', [CountryController::class, 'store'])->name(
        'countries.store'
    );
    Route::get('/countries/{country}', [
        CountryController::class,
        'show',
    ])->name('countries.show');
    Route::put('/countries/{country}', [
        CountryController::class,
        'update',
    ])->name('countries.update');
    Route::delete('/countries/{country}', [
        CountryController::class,
        'destroy',
    ])->name('countries.destroy');

    // Country Regions
    Route::get('/countries/{country}/regions', [
        CountryRegionsController::class,
        'index',
    ])->name('countries.regions.index');
    Route::post('/countries/{country}/regions', [
        CountryRegionsController::class,
        'store',
    ])->name('countries.regions.store');

    // Country Jobs
    Route::get('/countries/{country}/jobs', [
        CountryJobsController::class,
        'index',
    ])->name('countries.jobs.index');
    Route::post('/countries/{country}/jobs', [
        CountryJobsController::class,
        'store',
    ])->name('countries.jobs.store');

    Route::get('/currencies', [CurrencyController::class, 'index'])->name(
        'currencies.index'
    );
    Route::post('/currencies', [CurrencyController::class, 'store'])->name(
        'currencies.store'
    );
    Route::get('/currencies/{currency}', [
        CurrencyController::class,
        'show',
    ])->name('currencies.show');
    Route::put('/currencies/{currency}', [
        CurrencyController::class,
        'update',
    ])->name('currencies.update');
    Route::delete('/currencies/{currency}', [
        CurrencyController::class,
        'destroy',
    ])->name('currencies.destroy');

    // Currency Jobs
    Route::get('/currencies/{currency}/jobs', [
        CurrencyJobsController::class,
        'index',
    ])->name('currencies.jobs.index');
    Route::post('/currencies/{currency}/jobs', [
        CurrencyJobsController::class,
        'store',
    ])->name('currencies.jobs.store');

    Route::get('/departments', [DepartmentController::class, 'index'])->name(
        'departments.index'
    );
    Route::post('/departments', [DepartmentController::class, 'store'])->name(
        'departments.store'
    );
    Route::get('/departments/{department}', [
        DepartmentController::class,
        'show',
    ])->name('departments.show');
    Route::put('/departments/{department}', [
        DepartmentController::class,
        'update',
    ])->name('departments.update');
    Route::delete('/departments/{department}', [
        DepartmentController::class,
        'destroy',
    ])->name('departments.destroy');

    // Department Jobs
    Route::get('/departments/{department}/jobs', [
        DepartmentJobsController::class,
        'index',
    ])->name('departments.jobs.index');
    Route::post('/departments/{department}/jobs', [
        DepartmentJobsController::class,
        'store',
    ])->name('departments.jobs.store');

    // Department Users
    Route::get('/departments/{department}/users', [
        DepartmentUsersController::class,
        'index',
    ])->name('departments.users.index');
    Route::post('/departments/{department}/users', [
        DepartmentUsersController::class,
        'store',
    ])->name('departments.users.store');

    Route::get('/designations', [DesignationController::class, 'index'])->name(
        'designations.index'
    );
    Route::post('/designations', [DesignationController::class, 'store'])->name(
        'designations.store'
    );
    Route::get('/designations/{designation}', [
        DesignationController::class,
        'show',
    ])->name('designations.show');
    Route::put('/designations/{designation}', [
        DesignationController::class,
        'update',
    ])->name('designations.update');
    Route::delete('/designations/{designation}', [
        DesignationController::class,
        'destroy',
    ])->name('designations.destroy');

    // Designation Users
    Route::get('/designations/{designation}/users', [
        DesignationUsersController::class,
        'index',
    ])->name('designations.users.index');
    Route::post('/designations/{designation}/users', [
        DesignationUsersController::class,
        'store',
    ])->name('designations.users.store');
});
