<?php
namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Designation;
use App\Models\EducationLevel;
use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\Industry;
use App\Models\JobFunction;
use Illuminate\Support\Facades\Request;

class MiscellaneousController extends ServiceController
{
    public function countries()
    {
        try {            
            $countries = Country::all()
            ->orderby('id');
            return $this->success($countries);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function regions($country_id)
    {
        try {            
            $states = Region::where('country_id', $country_id)->get();
            return $this->success($states);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function cities($region_id)
    {
        try {            
            $cities = City::where('region_id', $region_id)->get();
            return $this->success($cities);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function currencies()
    {
        try {            
            $items = Currency::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function designations()
    {
        try {            
            $items = Designation::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function educationLevels()
    {
        try {            
            $items = EducationLevel::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function employmentTypes()
    {
        try {            
            $items = EmploymentType::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function experienceLevels()
    {
        try {            
            $items = ExperienceLevel::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function industries()
    {
        try {            
            $items = Industry::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

    public function jobFunctions()
    {
        try {            
            $items = JobFunction::all();
            return $this->success($items);
        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }

}
