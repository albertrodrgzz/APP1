<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permissions = [
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
            'view attendance',
            'create attendance',
            'edit attendance',
            'delete attendance',
            'view reports',
            'create reports',
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',
            'view positions',
            'create positions',
            'edit positions',
            'delete positions',
            'view payroll',
            'create payroll',
            'edit payroll',
            'view profile',
            'edit profile',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $employeeRole = Role::create(['name' => 'employee']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo(Permission::all());
        
        $managerRole->givePermissionTo([
            'view employees',
            'view attendance',
            'view reports',
            'view departments',
            'view positions',
            'view profile',
            'edit profile',
        ]);
        
        $employeeRole->givePermissionTo([
            'view attendance',
            'view profile',
            'edit profile',
        ]);

        // Crear departamentos
        $departments = [
            ['name' => 'Dirección General', 'description' => 'Dirección General del Instituto'],
            ['name' => 'Recursos Humanos', 'description' => 'Gestión de personal y talento humano'],
            ['name' => 'Telemática', 'description' => 'Dirección de Telemática'],
            ['name' => 'Administración', 'description' => 'Gestión administrativa y financiera'],
            ['name' => 'Académico', 'description' => 'Coordinación académica'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Crear posiciones
        $positions = [
            ['name' => 'Director General', 'description' => 'Director General del Instituto', 'department_id' => 1, 'level' => 'Ejecutivo'],
            ['name' => 'Director de RRHH', 'description' => 'Director de Recursos Humanos', 'department_id' => 2, 'level' => 'Directivo'],
            ['name' => 'Director de Telemática', 'description' => 'Director de Telemática', 'department_id' => 3, 'level' => 'Directivo'],
            ['name' => 'Administrador', 'description' => 'Administrador del Sistema', 'department_id' => 2, 'level' => 'Técnico'],
            ['name' => 'Analista de Sistemas', 'description' => 'Analista de Sistemas', 'department_id' => 3, 'level' => 'Técnico'],
            ['name' => 'Asistente Administrativo', 'description' => 'Asistente Administrativo', 'department_id' => 4, 'level' => 'Operativo'],
        ];

        foreach ($positions as $pos) {
            Position::create($pos);
        }

        // Crear empleados de ejemplo
        $employees = [
            [
                'employee_number' => 'EMP0001',
                'first_name' => 'Juan Carlos',
                'last_name' => 'García',
                'middle_name' => 'López',
                'email' => 'admin@sirh.com',
                'phone' => '(555) 123-4567',
                'hire_date' => '2020-01-15',
                'position_id' => 1,
                'department_id' => 1,
                'salary' => 50000.00,
                'employment_status' => 'Activo',
            ],
            [
                'employee_number' => 'EMP0002',
                'first_name' => 'María Elena',
                'last_name' => 'Rodríguez',
                'middle_name' => 'Martínez',
                'email' => 'manager@sirh.com',
                'phone' => '(555) 234-5678',
                'hire_date' => '2021-03-10',
                'position_id' => 2,
                'department_id' => 2,
                'salary' => 35000.00,
                'employment_status' => 'Activo',
            ],
            [
                'employee_number' => 'EMP0003',
                'first_name' => 'Carlos Alberto',
                'last_name' => 'Hernández',
                'middle_name' => 'González',
                'email' => 'employee@sirh.com',
                'phone' => '(555) 345-6789',
                'hire_date' => '2022-06-01',
                'position_id' => 4,
                'department_id' => 2,
                'salary' => 25000.00,
                'employment_status' => 'Activo',
            ],
        ];

        foreach ($employees as $emp) {
            Employee::create($emp);
        }

        // Crear usuarios
        $users = [
            [
                'name' => 'Juan Carlos García',
                'email' => 'admin@sirh.com',
                'password' => Hash::make('password'),
                'employee_id' => 1,
            ],
            [
                'name' => 'María Elena Rodríguez',
                'email' => 'manager@sirh.com',
                'password' => Hash::make('password'),
                'employee_id' => 2,
            ],
            [
                'name' => 'Carlos Alberto Hernández',
                'email' => 'employee@sirh.com',
                'password' => Hash::make('password'),
                'employee_id' => 3,
            ],
        ];

        foreach ($users as $index => $userData) {
            $user = User::create($userData);
            
            // Asignar roles
            if ($index === 0) {
                $user->assignRole('admin');
            } elseif ($index === 1) {
                $user->assignRole('manager');
            } else {
                $user->assignRole('employee');
            }
        }
    }
}

