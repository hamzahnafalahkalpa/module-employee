<?php

namespace Hanafalah\ModuleEmployee\Data;

use Hanafalah\ModuleEmployee\Contracts\Data\EmployeeTypeData as DataEmployeeTypeData;

class EmployeeTypeData extends EmployeeStuffData implements DataEmployeeTypeData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'EmployeeType';
        parent::before($attributes);
    }
}