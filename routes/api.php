<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ApplicantController;
use App\Http\Controllers\Api\AssesmentController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\InterviewController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\JobSettingController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\JobQuestionController;
use App\Http\Controllers\Api\MiscellaneousController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\InterviewSectionController;
use App\Http\Controllers\Api\ApplicantResponseController;
use App\Http\Controllers\Api\AssesmentQuestionController;
use App\Http\Controllers\Api\InterviewQuestionController;
use App\Http\Controllers\Api\CandidateEducationController;
use App\Http\Controllers\Api\CandidateAssessmentController;
use App\Http\Controllers\Api\CandidateExperienceController;
use App\Http\Controllers\Api\CandidateApplicationController;

use App\Http\Controllers\Api\ApplicantInterviewFeedbackController;
use App\Http\Controllers\Api\Career\JobController as CareerJobController;
use App\Http\Controllers\Api\Career\CandidateEducationController as CareerEducationController;
use App\Http\Controllers\Api\Career\AuthenticationController as CareerAuthenticationController;
use App\Http\Controllers\Api\Career\CandidateExperienceController as CareerExperienceController;


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
        Route::get('/{id}', [InterviewController::class, 'show'])->name('show');
    });

    //Vacancy Interview Sections Routes
    Route::name('vacancy.interview.sections')->prefix('vacancy-interview-sections')->middleware('auth:api')->group(function () {
        Route::post('/', [InterviewSectionController::class, 'store'])->name('store');
        Route::get('/{id}', [InterviewSectionController::class, 'show'])->name('show');
        Route::put('/{id}', [InterviewSectionController::class, 'update'])->name('update');
        Route::delete('/{id}', [InterviewSectionController::class, 'destroy'])->name('destroy');
    });

    //Vacancy Interview Section Questions Routes
    Route::name('vacancy.interview.section.questions')->prefix('vacancy-interview-section-questions')->middleware('auth:api')->group(function () {
        Route::post('/', [InterviewQuestionController::class, 'store'])->name('store');
        Route::put('/{id}', [InterviewQuestionController::class, 'update'])->name('update');
        Route::delete('/{id}', [InterviewQuestionController::class, 'destroy'])->name('destroy');
    });

     //Vacancy Assessment Routes
     Route::name('vacancy.assessments.')->prefix('vacancy-assessments')->middleware('auth:api')->group(function () {
        Route::post('/', [AssesmentController::class, 'store'])->name('store');
        Route::get('/{id}', [AssesmentController::class, 'show'])->name('show');
        Route::put('/{id}', [AssesmentController::class, 'update'])->name('update');
    });

    //Vacancy Assessment Questions Routes
    Route::name('vacancy.assessments.questions')->prefix('vacancy-assessment-questions')->middleware('auth:api')->group(function () {
        Route::get('/', [AssesmentQuestionController::class, 'index'])->name('index');
        Route::post('/', [AssesmentQuestionController::class, 'store'])->name('store');
        Route::post('/bulk', [AssesmentQuestionController::class, 'bulk'])->name('bulk.store');
        Route::get('/{id}', [AssesmentQuestionController::class, 'show'])->name('show');
        Route::delete('/{id}', [AssesmentQuestionController::class, 'destroy'])->name('destroy');
    });

    //Applicant Routes
    Route::name('applicants')->prefix('applicants')->middleware('auth:api')->group(function () {
        Route::get('/{vacancy_id}', [ApplicantController::class, 'index'])->name('index');
        Route::get('/single/{id}', [ApplicantController::class, 'show'])->name('show');
        Route::put('/bulk-move', [ApplicantController::class, 'bulkMove'])->name('bulk.move');
        Route::put('/{id}', [ApplicantController::class, 'move'])->name('move');
    });

    //Applicant Response Routes
    Route::name('applicant.responses')->prefix('applicant-responses')->middleware('auth:api')->group(function () {
        Route::get('/{applicant_id}', [ApplicantResponseController::class, 'index'])->name('index');
        Route::post('/', [ApplicantResponseController::class, 'store'])->name('store');
    });

    //Applicant Interviews Routes
    Route::name('applicant.interviews')->prefix('applicant-interviews')->middleware('auth:api')->group(function () {
        Route::get('/{applicant_id}', [ApplicantInterviewFeedbackController::class, 'index'])->name('index');
        Route::get('/single/{id}', [ApplicantInterviewFeedbackController::class, 'show'])->name('show');
        Route::post('/', [ApplicantInterviewFeedbackController::class, 'store'])->name('store');
        Route::delete('/{id}', [ApplicantInterviewFeedbackController::class, 'destroy'])->name('destroy');
    });

    //Candidates Routes
    Route::name('candidates')->prefix('candidates')->middleware('auth:api')->group(function () {
        Route::post('/', [CandidateController::class, 'store'])->name('store');
        Route::get('/', [CandidateController::class, 'index'])->name('index');
        Route::get('/{id}', [CandidateController::class, 'show'])->name('show');
        Route::put('/{id}', [CandidateController::class, 'update'])->name('update');
    });

    //Candidates' Education Routes
    Route::name('candidate.education')->prefix('candidate-education')->middleware('auth:api')->group(function () {
        Route::get('/{candidate_id}', [CandidateEducationController::class, 'index'])->name('index');
        Route::get('/single/{id}', [CandidateEducationController::class, 'show'])->name('show');
    });

    //Candidates' Experience Routes
    Route::name('candidate.experiences')->prefix('candidate-experiences')->middleware('auth:api')->group(function () {
        Route::get('/{candidate_id}', [CandidateExperienceController::class, 'index'])->name('index');
        Route::get('/single/{id}', [CandidateExperienceController::class, 'show'])->name('show');
    });

    //Candidates' Application Routes
    Route::name('candidate.applications')->prefix('candidate-applications')->middleware('auth:api')->group(function () {
        Route::get('/{id}', [CandidateApplicationController::class, 'index'])->name('index');
    });

    //Candidates' Assessment Routes
    Route::name('candidate.assessments')->prefix('candidate-assessments')->middleware('auth:api')->group(function () {
        Route::get('/{id}', [CandidateAssessmentController::class, 'index'])->name('index');
    });

    //Activities Routes
    Route::name('activities')->prefix('activities')->middleware('auth:api')->group(function () {
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/{id}', [ActivityController::class, 'show'])->name('show');
        Route::put('/{id}', [ActivityController::class, 'update'])->name('update');
        Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('delete');
    });

    //Roles Routes
    Route::name('roles')->prefix('roles')->middleware('auth:api')->group(function () {
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/{id}', [RoleController::class, 'show'])->name('show');
        Route::put('/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('delete');
    });

    //Permission Routes
    Route::name('permissions')->prefix('permissions')->middleware('auth:api')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
    });

    //Users Routes
    Route::name('users')->prefix('users')->middleware('auth:api')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Job Board Routes
    |--------------------------------------------------------------------------
    |
    | Here are the routes for the jobboard to list jobs and job details.
    |
    */

    Route::name('career-portal')->prefix('career-portal')->group(function(){        
        // Jobs routes
        Route::name('jobs.')->prefix('jobs')->group(function () {
            Route::get('/', [CareerJobController::class, 'index'])->name('index');
            Route::get('/{id}', [CareerJobController::class, 'show'])->name('show');
        });

        // Authentication routes 
        Route::name('auth.')->prefix('authentication')->group(function () {
            Route::post('/signup', [CareerAuthenticationController::class, 'signup'])->name('signup');
            Route::post('/resend-confirmation', [CareerAuthenticationController::class, 'resendConfirmation'])->name('resend.confirmation');
            Route::post('/email-confirmation', [CareerAuthenticationController::class, 'confirmation'])->name('email.confirmation');
            Route::post('/signin', [CareerAuthenticationController::class, 'signin'])->name('signin');
            Route::post('/forgot-password', [CareerAuthenticationController::class, 'forgotPassword'])->name('forgot.password');
            Route::post('/reset-password', [CareerAuthenticationController::class, 'resetPassword'])->name('reset.password');
        });

        // Account routes
        Route::name('account.')->prefix('account')->middleware('auth:auth:api-career')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::put('/', [AccountController::class, 'update'])->name('update');
        });

        //Candidates' Education Routes
        Route::name('candidate.education')->prefix('education')->middleware('auth:auth:api-career')->group(function () {
            Route::get('/', [CareerEducationController::class, 'index'])->name('index');
            Route::post('/', [CareerEducationController::class, 'store'])->name('store');
            Route::get('/{id}', [CareerEducationController::class, 'show'])->name('show');
            Route::put('/{id}', [CareerEducationController::class, 'update'])->name('update');
            Route::delete('/{id}', [CareerEducationController::class, 'destroy'])->name('destroy');
        });

        //Candidates' Experience Routes
        Route::name('candidate.experiences')->prefix('experiences')->middleware('auth:api-career')->group(function () {
            Route::get('/', [CareerExperienceController::class, 'index'])->name('index');
            Route::post('/', [CareerExperienceController::class, 'store'])->name('store');
            Route::get('/{id}', [CareerExperienceController::class, 'show'])->name('show');
            Route::put('/{id}', [CareerExperienceController::class, 'update'])->name('update');
            Route::delete('/{id}', [CareerExperienceController::class, 'destroy'])->name('destroy');
        });
    });
});
