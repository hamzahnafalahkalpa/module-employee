<?php

namespace Hanafalah\ModuleEmployee\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEmployee\Contracts\Data\CardIdentityData;
use Hanafalah\ModuleEmployee\Contracts\Data\EmployeeData as DataEmployeeData;
use Hanafalah\ModulePeople\Contracts\Data\PeopleData;
use Hanafalah\ModuleProfession\Contracts\Data\OccupationData;
use Hanafalah\ModuleUser\Contracts\Data\UserReferenceData;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class EmployeeData extends Data implements DataEmployeeData{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('uuid')]
    #[MapName('uuid')]
    public ?string $uuid = null;

    #[MapInputName('card_identity')]
    #[MapName('card_identity')]
    public ?CardIdentityData $card_identity = null;

    #[MapInputName('profession_id')]
    #[MapName('profession_id')]
    public mixed $profession_id = null;

    #[MapInputName('occupation_id')]
    #[MapName('occupation_id')]
    public mixed $occupation_id = null;

    #[MapInputName('occupation')]
    #[MapName('occupation')]
    public ?OccupationData $occupation = null;

    #[MapInputName('hired_at')]
    #[MapName('hired_at')]
    public ?string $hired_at = null;

    #[MapInputName('people')]
    #[MapName('people')]
    public PeopleData $people;

    #[MapInputName('user_reference')]
    #[MapName('user_reference')]
    public ?UserReferenceData $user_reference;

    #[MapInputName('employee_type_id')]
    #[MapName('employee_type_id')]
    public mixed $employee_type_id = null;

    #[MapInputName('employee_type')]
    #[MapName('employee_type')]
    public ?EmployeeTypeData $employee_type;

    #[MapInputName('employee_services')]
    #[MapName('employee_services')]
    #[DataCollectionOf(EmployeeServiceData::class)]
    public ?array $employee_services = null;

    #[MapInputName('shift_id')]
    #[MapName('shift_id')]
    public mixed $shift_id = null;

    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = null;

    #[MapInputName('profile')]
    #[MapName('profile')]
    public string|UploadedFile|null $profile = null;

    #[MapInputName('profile_dto')]
    #[MapName('profile_dto')]
    public ?ProfilePhotoData $profile_dto = null;
    
    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

    public static function after(EmployeeData $data): EmployeeData{
        $new = static::new();
        $data->name = $data->people->name;
        $props = &$data->props;

        $profession = $new->ProfessionModel();
        if (isset($data->profession_id)) $profession = $profession->findOrFail($data->profession_id);
        $props['prop_profession'] = $profession->toViewApi()->only(['id','flag','label','name']);
        
        $occupation = $new->OccupationModel();
        if (isset($data->occupation_id) || isset($data->occupation)){
            $occupation = isset($data->occupation_id)
                 ? $occupation->findOrFail($data->occupation_id)
                 : app(config('app.contracts.Occupation'))->prepareStoreOccupation($data->occupation);
        }
        $data->props['prop_occupation'] = $occupation->toViewApi()->only(['id','flag','label','name']);
        
        $data->props['prop_shift'] = [
            'id'   => $data->shift_id ?? null,
            'name' => null
        ];

        if (isset($data->props['prop_shift']['id']) && !isset($data->props['prop_shift']['name'])){
            $shift_model = $new->ShiftModel()->findOrFail($data->shift_id);
            $data->props['prop_shift']['name'] = $shift_model->name;
        }
        return $data;
    }
}