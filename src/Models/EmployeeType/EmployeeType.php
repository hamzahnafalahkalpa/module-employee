<?php

namespace Hanafalah\ModuleEmployee\Models\EmployeeType;

use Hanafalah\ModuleEmployee\Models\EmployeeStuff;
use Hanafalah\ModuleEmployee\Resources\EmployeeType\{ShowEmployeeType, ViewEmployeeType};

class EmployeeType extends EmployeeStuff{
    protected $table = 'unicodes';

    public function viewUsingRelation():array {
        return $this->mergeArray(parent::viewUsingRelation(),[
        ]);
    }

    public function showUsingRelation():array {
        return $this->mergeArray(parent::showUsingRelation(),[
        ]);
    }

    public function getViewResource(){
        return ViewEmployeeType::class;
    }

    public function getShowResource(){
        return ShowEmployeeType::class;
    }

    public function employeeHasType(){return $this->belongsToModel('EmployeeHasType');}
    public function employee(){return $this->belongsToModel('Employee');}
}