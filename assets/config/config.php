<?php

use Hanafalah\ModuleEmployee\{
    Commands as ModuleEmployeeCommands,
};
use Hanafalah\ModuleEmployee\Enums\Employee\CardIdentity;

return [
    'namespace' => 'Hanafalah\ModuleEmployee',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ]
    ],
    'libs'       => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'employee_identities' => CardIdentity::cases(),
    'database' => [
        'models' => [
            // ADD YOUR MODELS HERE
            ]
    ],
    'attendence_summary' => [
        'attendence' => [
            'start_work_hour' => '07:00:00',
            'schema' => 'AttendenceSummary'
        ],
        'annual_leave' => [
            'period' => 12,
            'schema' => 'AnnualLeaveSummary'
        ]
    ],
    'filesystem' => [
        'asset_url'     => '/assets/',
        'profile_photo' => 'profiles',
    ],
    'commands' => [
        ModuleEmployeeCommands\InstallMakeCommand::class
    ]
];
