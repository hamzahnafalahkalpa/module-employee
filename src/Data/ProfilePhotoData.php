<?php

namespace Hanafalah\ModuleEmployee\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEmployee\Contracts\Data\ProfilePhotoData as DataProfilePhotoData;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ProfilePhotoData extends Data implements DataProfilePhotoData{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('uuid')]
    #[MapName('uuid')]
    public ?string $uuid = null;

    #[MapInputName('employee_model')]
    #[MapName('employee_model')]
    public ?object $employee_model = null;

    #[MapInputName('profile')]
    #[MapName('profile')]
    public string|UploadedFile|null $profile = null;
}