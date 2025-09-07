<?php

namespace Hanafalah\ModuleEmployee\Seeders;

use Hanafalah\LaravelSupport\Concerns\Support\HasRequestData;
use Illuminate\Database\Seeder;

class EmployeeTypeSeeder extends Seeder{
    use HasRequestData;

    protected $__employee_types = [
        [
            'name' => 'PKWT',
            'note' => 'Perjanjian Kerja Waktu Tertentu'
        ],
        [
            'name' => 'PHL',
            'note' => 'Pegawai Harian Lepas'
        ],
        [
            'name' => 'Kontrak',
            'note' => 'Pegawai Kontrak'
        ],
        [
            'name' => 'Probation',
            'note' => 'Pegawai Probation'
        ],
        [
            'name' => 'Magang',
            'note' => 'Pegawai Magang'
        ],
        [
            'name' => 'Tetap',
            'note' => 'Pegawai Tetap'
        ],
        [
            'name' => 'Outsourcing',
            'note' => null
        ],
        [
            'name' => 'Intern',
            'note' => null
        ],
        [
            'name' => 'Freelance',
            'note' => null
        ]
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->__employee_types as $employee_type) {
            app(config('app.contracts.EmployeeType'))->prepareStoreEmployeeType(
                $this->requestDTO(config('app.contracts.EmployeeTypeData'),[
                    'name' => $employee_type['name'],
                    'label' => $employee_type['name'],
                    'note' => $employee_type['note'] ?? null
                ])
            );
        }
    }
}