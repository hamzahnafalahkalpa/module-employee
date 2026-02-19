<?php

namespace Hanafalah\ModuleEmployee\Resources\Employee;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewEmployee extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $profile = null;
        if (isset($this->profile)){
            $profile_path = employee_profile_photo($this->profile);
            $disk = config('filesystems.default', 'public');
            if ($disk == 'public') $profile_path = $this->encryptName($profile_path);
            $profile = asset_url($profile_path);
        }
        $arr = [
            'id'               => $this->id,
            'uuid'             => $this->uuid,
            'name'             => $this->name,
            'hired_at'         => $this->hired_at,
            'user_id'          => $this->user_id,
            'card_identity'    => $this->prop_card_identity,
            'people'           => $this->prop_people,
            'status'           => $this->status,
            'profile'          => $profile ?? null,
            'sign'             => $this->sign ?? null,    
            'profession'       => $this->prop_profession,
            'occupation'       => $this->prop_occupation,
            'current_attendence' => $this->prop_current_attendence,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at
        ];

        return $arr;
    }
}
