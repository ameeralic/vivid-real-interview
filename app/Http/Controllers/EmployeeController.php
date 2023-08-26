<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Employees/Index', [
            'users' => Employee::paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Employees/Create');
    }

    public function store()
    {
        // dd('ss');
        $attributes = $this->validateEmployee();

        $employee = Employee::create($attributes);

        if (Auth::guard('web')->check()) {
            if (Auth::user()->can('admin')) {
                return redirect('/admin-dashboard')->with('success', 'Employee has been created.');
            }
            return;
        }
        return;

    }


    public function edit(Employee $employee)
    {
        return Inertia::render('AdminDashboard/Employees/Edit', [
            'user' => $employee
        ]);

    }

    public function update(Employee $employee)
    {

        $attributes = $this->validateEmployee($employee);

        $employee->update($attributes);

        return back()->with('success', 'Employee Updated!');
    }

    public function destroy(Employee $employee)
    {
        // dd($teacher->course->all());
        $employee->delete();
       

        return redirect('/admin-dashboard/employees')->with('success', 'Employee Deleted!');
    }

    protected function validateEmployee( ? Employee $employee = null) : array
    {
        $employee ??= new Employee();

        return request()->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'phone' => 'required|min:10|max:12',
                'company_id' => 'required',
                'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($employee)],
            ]
        );
    }
}
