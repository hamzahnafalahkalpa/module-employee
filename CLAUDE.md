# CLAUDE.md - Module Employee

This file provides guidance to Claude Code when working with the `hanafalah/module-employee` package.

## Module Overview

The Module Employee package provides comprehensive employee management functionality for the Wellmed healthcare system. It handles employee data, attendance tracking, shift management, and employee services.

**Namespace:** `Hanafalah\ModuleEmployee`

## Dependencies

This module requires the following packages:
- `hanafalah/module-user` - User account management
- `hanafalah/module-people` - People/person data management
- `hanafalah/module-profession` - Professional roles and occupations
- `hanafalah/module-service` - Service definitions
- `hanafalah/laravel-support` - Core Laravel support utilities
- `hanafalah/module-transaction` - Transaction handling

## Directory Structure

```
src/
├── Commands/                    # Artisan commands
│   ├── InstallMakeCommand.php   # module-employee:install
│   └── EnvironmentCommand.php   # Base command class
├── Concerns/
│   └── HasAccessAttendence.php  # Attendance access trait
├── Contracts/                   # Interfaces
│   ├── Data/                    # Data transfer object contracts
│   └── Schemas/                 # Schema contracts
├── Data/                        # Data transfer objects (DTOs)
├── Enums/
│   ├── Employee/
│   │   ├── EmployeeStatus.php   # Employee status enum
│   │   └── CardIdentity.php     # Card identity types
│   └── Attendence/
│       └── Attendence.php       # Attendance enum
├── Facades/
│   └── ModuleEmployee.php       # Module facade
├── Models/
│   ├── Employee/
│   │   ├── ModelHasEmployee.php # Polymorphic employee relation
│   │   └── EmployeeService.php  # Employee services
│   ├── EmployeeType/
│   │   ├── EmployeeType.php     # Employee types
│   │   └── EmployeeHasType.php  # Employee-type relations
│   ├── Attendence/
│   │   ├── Attendence.php       # Attendance records
│   │   ├── Shift.php            # Work shifts
│   │   ├── ShiftSchedule.php    # Shift schedules
│   │   ├── ShiftHasSchedule.php # Shift-schedule relations
│   │   ├── EmployeeShift.php    # Employee-shift assignments
│   │   ├── AbsenceRequest.php   # Leave/absence requests
│   │   └── AttendenceSummary.php# Attendance summaries
│   └── EmployeeStuff.php        # Employee belongings/items
├── Providers/
│   └── CommandServiceProvider.php
├── Resources/                   # API resources for each entity
├── Schemas/                     # Business logic schemas
│   ├── Employee.php             # Employee CRUD operations
│   ├── Attendence.php           # Attendance operations
│   ├── Shift.php                # Shift management
│   ├── ShiftSchedule.php        # Schedule management
│   ├── ShiftHasSchedule.php     # Shift-schedule linking
│   ├── AbsenceRequest.php       # Leave requests
│   ├── AttendenceSummary.php    # Attendance reporting
│   ├── EmployeeService.php      # Employee services
│   ├── EmployeeStuff.php        # Employee items
│   └── EmployeeType.php         # Employee types
├── Seeders/
│   └── EmployeeTypeSeeder.php   # Default employee types
├── Supports/
│   └── BaseModuleEmployee.php   # Base class for schemas
├── ModuleEmployee.php           # Main module class
├── ModuleEmployeeServiceProvider.php
└── helper.php                   # Helper functions
```

## Key Components

### Employee Status Enum

Located in `src/Enums/Employee/EmployeeStatus.php`:
- `DRAFT` - Initial state
- `ACTIVE` - Currently employed
- `INACTIVE` - Not active
- `DELETED` - Soft deleted
- `RETIRED` - Retired employee
- `CONTRACT_ENDED` - Contract expired
- `INTERN` - Internship
- `PROBATION` - Probation period
- `DECEASED` - Deceased
- `RESIGNED` - Resigned

### Employee Types (Seeded)

The module seeds these employee types by default:
- PKWT (Perjanjian Kerja Waktu Tertentu)
- PHL (Pegawai Harian Lepas)
- Kontrak (Contract)
- Probation
- Magang (Internship)
- Tetap (Permanent)
- Outsourcing
- Intern
- Freelance

### Attendance Types

The attendance schema supports three operation types:
- `CHECK IN` - Records check-in time with shift assignment
- `CHECK OUT` - Records check-out time
- `APPROVAL` - Updates attendance status for approval workflows

## Service Provider Registration

The `ModuleEmployeeServiceProvider` extends `BaseServiceProvider` and:
1. Registers the main `ModuleEmployee` class
2. Registers command service provider
3. Binds contract interfaces to implementations:
   - `ProfileEmployee` -> `Schemas\Employee`
   - `ProfilePhoto` -> `Schemas\Employee`

## BaseServiceProvider Warning

**CRITICAL:** The `ModuleEmployeeServiceProvider` extends `Hanafalah\LaravelSupport\Providers\BaseServiceProvider`.

When working with this service provider:
1. **DO NOT** override the `boot()` method without calling `parent::boot()`
2. The `registers(['*'])` pattern auto-registers all contracts, data, schemas, and resources
3. Use `registerMainClass()` to set the primary module class
4. Use `registerCommandService()` for artisan commands
5. Custom bindings should be added in the `registers()` callback

### Service Provider Pattern

```php
public function register()
{
    $this->registerMainClass(ModuleEmployee::class)
        ->registerCommandService(Providers\CommandServiceProvider::class)
        ->registers([
            '*',  // Auto-register all standard components
            'Services' => function(){
                // Custom service bindings here
                $this->binds([...]);
            }
        ]);
}
```

## Schema Pattern

All schemas extend `BaseModuleEmployee` which provides:
- Configuration management via `$__config_name`
- Entity naming via `$__entity`
- Caching configuration via `$__cache`
- Database transactions via `$this->transaction()`
- DTO request handling via `$this->requestDTO()`

### Example Schema Usage

```php
// Get employee schema
$employeeSchema = app(ContractsEmployee::class);

// Create/update employee
$employee = $employeeSchema->prepareStoreEmployee($employeeData);

// Show employee
$result = $employeeSchema->showEmployee($employee);

// Delete employee
$deleted = $employeeSchema->prepareDeleteEmployee(['id' => $id]);
```

## Helper Functions

The module provides these global helper functions in `src/helper.php`:

```php
// Generate asset URL (supports S3 and local storage)
asset_url(string $url): string

// Generate employee profile photo URL
employee_profile_photo(string $photo): string
```

## Artisan Commands

```bash
# Install the module (publishes config and migrations)
php artisan module-employee:install
```

## Configuration

After installation, configuration is available at `config/module-employee.php`. Key settings include:
- `employee_identities` - Card identity types
- `filesystem.profile_photo` - Profile photo storage path
- `commands` - Available artisan commands

## Models and Relationships

### ModelHasEmployee (Polymorphic)
Allows any model to have employee associations:
```php
$model->employee()  // belongsTo Employee
$model->model()     // morphTo (parent model)
```

### Attendence Model
```php
$attendence->employee()      // belongsTo Employee
$attendence->author()        // morphTo (who recorded)
$attendence->shift()         // belongsTo Shift
$attendence->absenceRequest()// belongsTo AbsenceRequest
```

## Integration with Wellmed

This module integrates with:
- **ms-hr** feature module for HR management
- **wellmed-backbone** for API endpoints
- Multi-tenant architecture (tenant-scoped employee data)

## Octane Compatibility

This module follows Octane-safe patterns:
- No static state storage
- Uses request-scoped services
- Proper tenant isolation through parent modules

## Common Operations

### Creating an Employee
```php
$schema = app(ContractsEmployee::class);
$employee = $schema->prepareStoreEmployee(
    $this->requestDTO(EmployeeData::class, [
        'name' => 'John Doe',
        'employee_type_id' => $typeId,
        'people' => [...],
        'user_reference' => [...],
    ])
);
```

### Recording Attendance
```php
$schema = app(ContractsAttendence::class);
$attendence = $schema->prepareStoreAttendence(
    $this->requestDTO(AttendenceData::class, [
        'type' => 'CHECK IN',
        'employee_id' => $employeeId,
        'shift_id' => $shiftId,
        'employee_model' => $employee,
    ])
);
```

### Managing Shifts
```php
$schema = app(ContractsShift::class);
$shift = $schema->prepareStoreShift(
    $this->requestDTO(ShiftData::class, [
        'name' => 'Morning Shift',
        'off_days' => ['Saturday', 'Sunday'],
        'shift_schedules' => [...],
    ])
);
```
