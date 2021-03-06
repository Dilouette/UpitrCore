<?php
namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\Designation;
use App\Models\JobFunction;
use App\Enums\ActivityTypes;
use App\Models\QuestionType;
use App\Models\EducationLevel;
use App\Models\EmploymentType;
use App\Enums\ImportanceLevels;
use App\Models\ExperienceLevel;
use App\Enums\ActivityRelations;
use App\Enums\ActivityStatuses;
use App\Enums\DegreeClassification;
use Illuminate\Support\Facades\Request;

class MiscellaneousController extends ServiceController
{
    public function countries()
    {
        try {            
            $countries = Country::orderBy('created_at')->get();
            return $this->success($countries);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function regions($country_id)
    {
        try {            
            $states = Region::where('country_id', $country_id)->orderby('created_at')->get();            
            return $this->success($states);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function cities($region_id)
    {
        try {            
            $cities = City::where('region_id', $region_id)->orderby('created_at')->get();
            return $this->success($cities);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function currencies()
    {
        try {            
            $items = Currency::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function designations()
    {
        try {            
            $items = Designation::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function educationLevels()
    {
        try {            
            $items = EducationLevel::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function employmentTypes()
    {
        try {            
            $items = EmploymentType::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function experienceLevels()
    {
        try {            
            $items = ExperienceLevel::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function industries()
    {
        try {            
            $items = Industry::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function jobFunctions()
    {
        try {            
            $items = JobFunction::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function questionTypes()
    {
        try {            
            $items = QuestionType::orderBy('created_at')->get();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function degreeClassifications()
    {
        try {            
            $classification_enums = DegreeClassification::asSelectArray();
            $classifications = [];
            foreach ($classification_enums as $key => $value) {
                $classification=[
                    'value'=> $key,
                    'name'=> $value
                ];
                array_push($classifications, $classification);
            }
            return $this->success($classifications);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function activityTypes()
    {
        try {            
            $enums = ActivityTypes::asSelectArray();
            $items = [];
            foreach ($enums as $key => $value) {
                $item=[
                    'value'=> $key,
                    'name'=> $value
                ];
                array_push($items, $item);
            }
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function activityRelations()
    {
        try {            
            $enums = ActivityRelations::asSelectArray();
            $items = [];
            foreach ($enums as $key => $value) {
                $item=[
                    'value'=> $key,
                    'name'=> $value
                ];
                array_push($items, $item);
            }
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function activityImportance()
    {
        try {            
            $enums = ImportanceLevels::asSelectArray();
            $items = [];
            foreach ($enums as $key => $value) {
                $item=[
                    'value'=> $key,
                    'name'=> $value
                ];
                array_push($items, $item);
            }
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function activityStatuses()
    {
        try {            
            $enums = ActivityStatuses::asSelectArray();
            $items = [];
            foreach ($enums as $key => $value) {
                $item=[
                    'value'=> $key,
                    'name'=> $value
                ];
                array_push($items, $item);
            }
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

}
