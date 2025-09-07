<?php

namespace Hanafalah\ModuleEmployee\Resources\EmployeeType;

use Hanafalah\ModuleEmployee\Resources\EmployeeStuff\ViewEmployeeStuff;

class ViewEmployeeType extends ViewEmployeeStuff
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'note' => $this->note
        ];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
