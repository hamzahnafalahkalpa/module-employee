<?php

namespace Hanafalah\ModuleEmployee\Enums\Employee;

enum CardIdentity: string
{
    case SIP = 'sip';
    case SIK = 'sik';
    case NIP = 'nip';
    case STR = 'str';
    case BPJS_KETENAGAKERJAAN = 'bpjs_ketenagakerjaan';
}
