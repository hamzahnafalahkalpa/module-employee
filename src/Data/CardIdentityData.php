<?php

namespace Hanafalah\ModuleEmployee\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEmployee\Contracts\Data\CardIdentityData as DataCardIdentityData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class CardIdentityData extends Data implements DataCardIdentityData{
    #[MapInputName('nip')]
    #[MapName('nip')]
    public ?string $nip = null;
    
    #[MapInputName('sip')]
    #[MapName('sip')]
    public ?string $sip = null;

    #[MapInputName('sik')]
    #[MapName('sik')]
    public ?string $sik = null;

    #[MapInputName('str')]
    #[MapName('str')]
    public ?string $str = null;

    #[MapInputName('bpjs_ketenagakerjaan')]
    #[MapName('bpjs_ketenagakerjaan')]
    public ?string $bpjs_ketenagakerjaan = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
}