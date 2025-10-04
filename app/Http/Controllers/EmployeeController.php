<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use App\Models\EmployeeDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['position', 'department', 'manager'])
            ->where('is_active', true)
            ->paginate(15);
            
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->get();
        $managers = Employee::where('is_active', true)->get();
        
        return view('employees.create', compact('positions', 'departments', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string|max:20',
            'hire_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric|min:0',
        ]);

        // Generar número de empleado único
        $employeeNumber = 'EMP' . str_pad(Employee::count() + 1, 4, '0', STR_PAD_LEFT);

        $employee = Employee::create([
            'employee_number' => $employeeNumber,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'national_id' => $request->national_id,
            'tax_id' => $request->tax_id,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
            'hire_date' => $request->hire_date,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
            'manager_id' => $request->manager_id,
            'salary' => $request->salary,
            'employment_status' => $request->employment_status ?? 'Activo',
            'work_schedule' => $request->work_schedule ?? 'Lunes a Viernes 8:00-17:00',
        ]);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Empleado creado exitosamente.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['position', 'department', 'manager', 'documents', 'attendances' => function($query) {
            $query->latest()->limit(10);
        }]);
        
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $positions = Position::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->get();
        $managers = Employee::where('is_active', true)
            ->where('id', '!=', $employee->id)
            ->get();
        
        return view('employees.edit', compact('employee', 'positions', 'departments', 'managers'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'hire_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Employee $employee)
    {
        $employee->update(['is_active' => false]);
        
        return redirect()->route('employees.index')
            ->with('success', 'Empleado desactivado exitosamente.');
    }

    public function profile()
    {
        $employee = auth()->user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')
                ->with('error', 'No se encontró información del empleado.');
        }

        $employee->load(['position', 'department', 'manager', 'documents']);
        
        return view('employees.profile', compact('employee'));
    }

    public function editProfile()
    {
        $employee = auth()->user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')
                ->with('error', 'No se encontró información del empleado.');
        }

        return view('employees.edit-profile', compact('employee'));
    }

    public function updateProfile(Request $request)
    {
        $employee = auth()->user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')
                ->with('error', 'No se encontró información del empleado.');
        }

        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:100',
        ]);

        $employee->update($request->only([
            'phone', 'address', 'city', 'state', 'postal_code',
            'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship'
        ]));

        return redirect()->route('profile.index')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    public function documents()
    {
        $employee = auth()->user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')
                ->with('error', 'No se encontró información del empleado.');
        }

        $documents = $employee->documents()->latest()->get();
        
        return view('employees.documents', compact('employee', 'documents'));
    }
}

