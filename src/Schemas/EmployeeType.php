<?php

namespace Hanafalah\ModuleEmployee\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\{
    Builder,
    Collection,
    Model
};
use Hanafalah\ModuleEmployee\Contracts\Schemas\EmployeeType as ContractsEmployeeType;
use Hanafalah\ModuleEmployee\Contracts\Data\EmployeeTypeData;

class EmployeeType extends EmployeeStuff implements ContractsEmployeeType
{
    protected string $__entity = 'EmployeeType';
    public $employee_type_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'employee_type',
            'tags'     => ['employee_type', 'employee_type-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreEmployeeType(EmployeeTypeData $employee_type_dto): Model{
        $employee_type = $this->prepareStoreEmployeeStuff($employee_type_dto);
        return $this->employee_type_model = $employee_type;
    }

    public function employeeType(mixed $conditionals = null): Builder{
        return $this->employeeStuff($conditionals);
    }
}

