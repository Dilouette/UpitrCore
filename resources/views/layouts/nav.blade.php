<nav x-data="{ open: false }" class="bg-white shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-bold text-blue-500 text-lg">
                        UpitrCore
                    </a>
                </div>

                @auth
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>

                    
                    <x-nav-dropdown title="Apps" align="right" width="48">
                            @can('view-any', App\Models\Activity::class)
                            <x-dropdown-link href="{{ route('activities.index') }}">
                            Activities
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantAssesment::class)
                            <x-dropdown-link href="{{ route('applicant-assesments.index') }}">
                            Applicant Assesments
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantEducation::class)
                            <x-dropdown-link href="{{ route('applicant-educations.index') }}">
                            Applicant Educations
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantExperience::class)
                            <x-dropdown-link href="{{ route('applicant-experiences.index') }}">
                            Applicant Experiences
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantInterview::class)
                            <x-dropdown-link href="{{ route('applicant-interviews.index') }}">
                            Applicant Interviews
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantInterviewFeedback::class)
                            <x-dropdown-link href="{{ route('applicant-interview-feedbacks.index') }}">
                            Applicant Interview Feedbacks
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\User::class)
                            <x-dropdown-link href="{{ route('users.index') }}">
                            Users
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Region::class)
                            <x-dropdown-link href="{{ route('regions.index') }}">
                            Regions
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\QuestionType::class)
                            <x-dropdown-link href="{{ route('question-types.index') }}">
                            Question Types
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Note::class)
                            <x-dropdown-link href="{{ route('notes.index') }}">
                            Notes
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobWorkflowStage::class)
                            <x-dropdown-link href="{{ route('job-workflow-stages.index') }}">
                            Job Workflow Stages
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobWorkflow::class)
                            <x-dropdown-link href="{{ route('job-workflows.index') }}">
                            Job Workflows
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobSetting::class)
                            <x-dropdown-link href="{{ route('job-settings.index') }}">
                            Job Settings
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobQuestionOption::class)
                            <x-dropdown-link href="{{ route('job-question-options.index') }}">
                            Job Question Options
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobQuestion::class)
                            <x-dropdown-link href="{{ route('job-questions.index') }}">
                            Job Questions
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobFunction::class)
                            <x-dropdown-link href="{{ route('job-functions.index') }}">
                            Job Functions
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\JobApplicant::class)
                            <x-dropdown-link href="{{ route('job-applicants.index') }}">
                            Job Applicants
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Job::class)
                            <x-dropdown-link href="{{ route('jobs.index') }}">
                            Jobs
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\InteviewQuestion::class)
                            <x-dropdown-link href="{{ route('inteview-questions.index') }}">
                            Inteview Questions
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\InterviewSection::class)
                            <x-dropdown-link href="{{ route('interview-sections.index') }}">
                            Interview Sections
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Interview::class)
                            <x-dropdown-link href="{{ route('interviews.index') }}">
                            Interviews
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Industry::class)
                            <x-dropdown-link href="{{ route('industries.index') }}">
                            Industries
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ExperienceLevel::class)
                            <x-dropdown-link href="{{ route('experience-levels.index') }}">
                            Experience Levels
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\EmploymentType::class)
                            <x-dropdown-link href="{{ route('employment-types.index') }}">
                            Employment Types
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\EducationLevel::class)
                            <x-dropdown-link href="{{ route('education-levels.index') }}">
                            Education Levels
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ApplicantResponse::class)
                            <x-dropdown-link href="{{ route('applicant-responses.index') }}">
                            Applicant Responses
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Assesment::class)
                            <x-dropdown-link href="{{ route('assesments.index') }}">
                            Assesments
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AssesmentQuestion::class)
                            <x-dropdown-link href="{{ route('assesment-questions.index') }}">
                            Assesment Questions
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AssesmentQuestionOption::class)
                            <x-dropdown-link href="{{ route('assesment-question-options.index') }}">
                            Assesment Question Options
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AssesmentResponse::class)
                            <x-dropdown-link href="{{ route('assesment-responses.index') }}">
                            Assesment Responses
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\BenefitTemplate::class)
                            <x-dropdown-link href="{{ route('benefit-templates.index') }}">
                            Benefit Templates
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\City::class)
                            <x-dropdown-link href="{{ route('cities.index') }}">
                            Cities
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Company::class)
                            <x-dropdown-link href="{{ route('companies.index') }}">
                            Companies
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Country::class)
                            <x-dropdown-link href="{{ route('countries.index') }}">
                            Countries
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Currency::class)
                            <x-dropdown-link href="{{ route('currencies.index') }}">
                            Currencies
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Department::class)
                            <x-dropdown-link href="{{ route('departments.index') }}">
                            Departments
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Designation::class)
                            <x-dropdown-link href="{{ route('designations.index') }}">
                            Designations
                            </x-dropdown-link>
                            @endcan
                    </x-nav-dropdown>

                @endauth
                
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

                @can('view-any', App\Models\Activity::class)
                <x-responsive-nav-link href="{{ route('activities.index') }}">
                Activities
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantAssesment::class)
                <x-responsive-nav-link href="{{ route('applicant-assesments.index') }}">
                Applicant Assesments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantEducation::class)
                <x-responsive-nav-link href="{{ route('applicant-educations.index') }}">
                Applicant Educations
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantExperience::class)
                <x-responsive-nav-link href="{{ route('applicant-experiences.index') }}">
                Applicant Experiences
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantInterview::class)
                <x-responsive-nav-link href="{{ route('applicant-interviews.index') }}">
                Applicant Interviews
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantInterviewFeedback::class)
                <x-responsive-nav-link href="{{ route('applicant-interview-feedbacks.index') }}">
                Applicant Interview Feedbacks
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\User::class)
                <x-responsive-nav-link href="{{ route('users.index') }}">
                Users
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Region::class)
                <x-responsive-nav-link href="{{ route('regions.index') }}">
                Regions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\QuestionType::class)
                <x-responsive-nav-link href="{{ route('question-types.index') }}">
                Question Types
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Note::class)
                <x-responsive-nav-link href="{{ route('notes.index') }}">
                Notes
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobWorkflowStage::class)
                <x-responsive-nav-link href="{{ route('job-workflow-stages.index') }}">
                Job Workflow Stages
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobWorkflow::class)
                <x-responsive-nav-link href="{{ route('job-workflows.index') }}">
                Job Workflows
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobSetting::class)
                <x-responsive-nav-link href="{{ route('job-settings.index') }}">
                Job Settings
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobQuestionOption::class)
                <x-responsive-nav-link href="{{ route('job-question-options.index') }}">
                Job Question Options
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobQuestion::class)
                <x-responsive-nav-link href="{{ route('job-questions.index') }}">
                Job Questions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobFunction::class)
                <x-responsive-nav-link href="{{ route('job-functions.index') }}">
                Job Functions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobApplicant::class)
                <x-responsive-nav-link href="{{ route('job-applicants.index') }}">
                Job Applicants
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Job::class)
                <x-responsive-nav-link href="{{ route('jobs.index') }}">
                Jobs
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\InteviewQuestion::class)
                <x-responsive-nav-link href="{{ route('inteview-questions.index') }}">
                Inteview Questions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\InterviewSection::class)
                <x-responsive-nav-link href="{{ route('interview-sections.index') }}">
                Interview Sections
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Interview::class)
                <x-responsive-nav-link href="{{ route('interviews.index') }}">
                Interviews
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Industry::class)
                <x-responsive-nav-link href="{{ route('industries.index') }}">
                Industries
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ExperienceLevel::class)
                <x-responsive-nav-link href="{{ route('experience-levels.index') }}">
                Experience Levels
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\EmploymentType::class)
                <x-responsive-nav-link href="{{ route('employment-types.index') }}">
                Employment Types
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\EducationLevel::class)
                <x-responsive-nav-link href="{{ route('education-levels.index') }}">
                Education Levels
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ApplicantResponse::class)
                <x-responsive-nav-link href="{{ route('applicant-responses.index') }}">
                Applicant Responses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Assesment::class)
                <x-responsive-nav-link href="{{ route('assesments.index') }}">
                Assesments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AssesmentQuestion::class)
                <x-responsive-nav-link href="{{ route('assesment-questions.index') }}">
                Assesment Questions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AssesmentQuestionOption::class)
                <x-responsive-nav-link href="{{ route('assesment-question-options.index') }}">
                Assesment Question Options
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AssesmentResponse::class)
                <x-responsive-nav-link href="{{ route('assesment-responses.index') }}">
                Assesment Responses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\BenefitTemplate::class)
                <x-responsive-nav-link href="{{ route('benefit-templates.index') }}">
                Benefit Templates
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\City::class)
                <x-responsive-nav-link href="{{ route('cities.index') }}">
                Cities
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Company::class)
                <x-responsive-nav-link href="{{ route('companies.index') }}">
                Companies
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Country::class)
                <x-responsive-nav-link href="{{ route('countries.index') }}">
                Countries
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Currency::class)
                <x-responsive-nav-link href="{{ route('currencies.index') }}">
                Currencies
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Department::class)
                <x-responsive-nav-link href="{{ route('departments.index') }}">
                Departments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Designation::class)
                <x-responsive-nav-link href="{{ route('designations.index') }}">
                Designations
                </x-responsive-nav-link>
                @endcan

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>