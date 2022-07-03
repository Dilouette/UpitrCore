<?php

use App\Models\Department;
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
use App\Http\Controllers\Api\DashboardController;
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
        Route::get('/question-types', [MiscellaneousController::class, 'questionTypes'])->name('question-types');
        Route::get('/degree-classifications', [MiscellaneousController::class, 'degreeClassifications'])->name('degree-classifications');
        Route::get('/activity-types', [MiscellaneousController::class, 'activityTypes'])->name('activity-types');
        Route::get('/activity-relations', [MiscellaneousController::class, 'activityRelations'])->name('activity-relations');
        Route::get('/activity-importance', [MiscellaneousController::class, 'activityImportance'])->name('activity-importance');
        
    });

    //Dashboard Routes
    Route::name('dashboard.')->prefix('dashboard')->middleware('auth:api')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    //Department Routes
    Route::name('department.')->prefix('departments')->middleware('auth:api')->group(function () {
        Route::post('/', [DepartmentController::class, 'store'])->name('store');
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/{id}', [DepartmentController::class, 'show'])->name('show');
        Route::put('/{id}', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [DepartmentController::class, 'destroy'])->name('destroy');
    });

    //Vacancy Routes
    Route::name('vacancy.')->prefix('vacancies')->middleware('auth:api')->group(function () {
        Route::post('/', [JobController::class, 'store'])->name('store');
        Route::get('/', [JobController::class, 'index'])->name('index');
        Route::get('/active', [JobController::class, 'active'])->name('active');
        Route::get('/{id}', [JobController::class, 'show'])->name('show');
        Route::put('/{id}', [JobController::class, 'update'])->name('update');
        Route::put('/publish/{id}', [JobController::class, 'publish'])->name('publish');
        Route::put('/unpublish/{id}', [JobController::class, 'unpublish'])->name('unpublish');
        Route::delete('/{id}', [JobController::class, 'destroy'])->name('destroy');
    });

    //Vacancy Settings Routes
    Route::name('vacancy.settings.')->prefix('vacancy-setting')->middleware('auth:api')->group(function () {
        Route::post('/', [JobSettingController::class, 'store'])->name('store');
        Route::get('/{id}', [JobSettingController::class, 'show'])->name('show');
        Route::put('/{id}', [JobSettingController::class, 'update'])->name('update');
    });

    //Vacancy Questions Routes
    Route::name('vacancy.questions.')->prefix('vacancy-questions')->middleware('auth:api')->group(function () {
        Route::post('/', [JobQuestionController::class, 'store'])->name('store');
        Route::get('/{id}', [JobQuestionController::class, 'show'])->name('show');
        Route::put('/{id}', [JobQuestionController::class, 'update'])->name('update');
        Route::delete('/{id}', [JobQuestionController::class, 'destroy'])->name('destroy');
    });

    //Vacancy Interviews Routes
    Route::name('vacancy.interviews.')->prefix('vacancy-interviews')->middleware('auth:api')->group(function () {
        Route::get('/{id}/{vacancy_id}', [InterviewController::class, 'show'])->name('show');
    });

    //Vacancy Interview Sections Routes
    Route::name('vacancy.interview.sections')->prefix('vacancy-interview-sections')->middleware('auth:api')->group(function () {
        Route::post('/', [InterviewSectionController::class, 'store'])->name('store');
        Route::get('/{id}', [InterviewSectionController::class, 'show'])->name('show');
        Route::put('/{id}', [InterviewSectionController::class, 'update'])->name('update');
        Route::delete('/{id}', [InterviewSectionController::class, 'destroy'])->name('destroy');
    });

     //Vacancy Assessment Routes
     Route::name('vacancy.assessments.')->prefix('vacancy-assessments')->middleware('auth:api')->group(function () {
        Route::post('/', [AssesmentController::class, 'store'])->name('store');
        Route::get('/{id}', [AssesmentController::class, 'show'])->name('show');
        Route::put('/{id}', [AssesmentController::class, 'update'])->name('update');
    });

    //Vacancy Assessment Questions Routes
    Route::name('vacancy.assessments.questions')->prefix('vacancy-assessment-questions')->middleware('auth:api')->group(function () {
        Route::post('/', [AssesmentQuestionController::class, 'store'])->name('store');
        Route::post('/bulk', [AssesmentQuestionController::class, 'bulk'])->name('bulk.store');
        Route::get('/{id}', [AssesmentQuestionController::class, 'show'])->name('show');
        Route::put('/{id}', [AssesmentQuestionController::class, 'update'])->name('update');
        Route::delete('/{id}', [AssesmentQuestionController::class, 'destroy'])->name('destroy');
    });

    //Candidates Routes
    Route::name('candidates')->prefix('candidates')->middleware('auth:api')->group(function () {
        Route::post('/', [JobApplicantController::class, 'store'])->name('store');
        Route::get('/', [JobApplicantController::class, 'index'])->name('index');
        Route::get('/{id}', [JobApplicantController::class, 'show'])->name('show');
        Route::post('/{id}', [JobApplicantController::class, 'update'])->name('update');
        Route::put('/move/{id}', [JobApplicantController::class, 'move'])->name('move');
    });

    //Candidates' Vacancy Questions Routes
    Route::name('candidate.responses')->prefix('candidate-responses')->middleware('auth:api')->group(function () {
        Route::get('/{applicant_id}', [ApplicantResponseController::class, 'index'])->name('index');
        Route::post('/', [ApplicantResponseController::class, 'store'])->name('store');
    });

    //Candidates' Education Routes
    Route::name('candidate.education')->prefix('candidate-education')->middleware('auth:api')->group(function () {
        Route::get('/{applicant_id}', [ApplicantEducationController::class, 'index'])->name('index');
        Route::post('/', [ApplicantEducationController::class, 'store'])->name('store');
        Route::put('/{id}', [ApplicantEducationController::class, 'update'])->name('update');
        Route::delete('/{id}', [ApplicantEducationController::class, 'destroy'])->name('destroy');
    });

    //Candidates' Experience Routes
    Route::name('candidate.experiences')->prefix('candidate-experiences')->middleware('auth:api')->group(function () {
        Route::get('/{applicant_id}', [ApplicantExperienceController::class, 'index'])->name('index');
        Route::post('/', [ApplicantExperienceController::class, 'store'])->name('store');
        Route::put('/{id}', [ApplicantExperienceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ApplicantExperienceController::class, 'destroy'])->name('destroy');
    });

    //Activities Routes
    Route::name('activities')->prefix('activities')->middleware('auth:api')->group(function () {
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/{id}', [ActivityController::class, 'show'])->name('show');
        Route::put('/{id}', [ActivityController::class, 'update'])->name('update');
        Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('delete');
    });

    //Users Routes
    Route::name('users')->prefix('users')->middleware('auth:api')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    //Job Board
    Route::name('jobs.')->prefix('jobs')->group(function () {
        Route::post('/', [JobController::class, 'store'])->name('store');
        Route::get('/active', [JobController::class, 'active'])->name('active');
        Route::get('/{id}', [JobController::class, 'show'])->name('show');
        Route::put('/{id}', [JobController::class, 'update'])->name('update');
    });

});
