<?php

namespace Hanafalah\ModuleEmployee\Resources\EmployeeType;

use Hanafalah\ModuleEmployee\Resources\EmployeeStuff\ShowEmployeeStuff;

class ShowEmployeeType extends ViewEmployeeType
{

    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $show = $this->resolveNow(new ShowEmployeeStuff($this));
        $arr = array_merge(parent::toArray($request), $show, $arr);
        return $arr;
    }
}
