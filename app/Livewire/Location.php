<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Department;
use App\Models\Neighborhood;
use Livewire\Component;

class Location extends Component
{
  public $departments;
  public $cities = [];
  public $neighborhoods = [];
  public $departmentId;
  public $cityId;
  public $neighborhoodId;

  public function mount()
  {
    $this->departments = Department::all();
    $this->cities = collect();
    $this->neighborhoods = collect();
  }

    public function render()
    {
        return view('livewire.location');
        
    }

    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id',$value)->get();
        $this->city = $this->cities->first()->id ?? null;
    }

    public function updatedCityId($value)
    {
        $this->neighborhoods = Neighborhood::where('city_id',$value)->get();
        $this->neighborhood = $this->neighborhoods->first()->id ?? null;

    }
    
}
