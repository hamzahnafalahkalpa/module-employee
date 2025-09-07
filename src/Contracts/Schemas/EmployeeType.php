<?php

namespace Hanafalah\ModuleEmployee\Contracts\Schemas;

/**
 * @see \Hanafalah\ModuleEmployee\Schemas\EmployeeType
 * @method mixed export(string $type)
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array updateEmployeeType(?EmployeeTypeData $employee_type_dto = null)
 * @method Model prepareUpdateEmployeeType(EmployeeTypeData $employee_type_dto)
 * @method bool deleteEmployeeType()
 * @method bool prepareDeleteEmployeeType(? array $attributes = null)
 * @method mixed getEmployeeType()
 * @method ?Model prepareShowEmployeeType(?Model $model = null, ?array $attributes = null)
 * @method array showEmployeeType(?Model $model = null)
 * @method Collection prepareViewEmployeeTypeList()
 * @method array viewEmployeeTypeList()
 * @method LengthAwarePaginator prepareViewEmployeeTypePaginate(PaginateData $paginate_dto)
 * @method array viewEmployeeTypePaginate(?PaginateData $paginate_dto = null)
 * @method array storeEmployeeType(?EmployeeTypeData $employee_type_dto = null);
 */
interface EmployeeType extends EmployeeStuff
{
    
}
