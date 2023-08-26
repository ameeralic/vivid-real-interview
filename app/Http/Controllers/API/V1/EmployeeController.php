<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EmployeeResource;
use App\Http\Resources\V1\EmployeeCollection;
use App\Http\Requests\V1\Employee\StoreRequest;
use App\Http\Requests\V1\Employee\UpdateRequest;

class EmployeeController extends Controller
{
    //
    public function index()
    {

        return new EmployeeCollection(Employee::paginate(10));

    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return new EmployeeResource($employee);
    }

    public function store()
    {
        $attributes = $this->validateEmployee();
        return new EmployeeResource(Employee::create($attributes));
    }

    public function update($id)
    {
        $employee = Employee::findOrFail($id);
        $attributes = $this->validateEmployee($employee);
        if ($employee->update($attributes)) {
            return response()->json(
                ['message' => 'Update Successfull!']
            );
        } else {
            return response()->json(
                ['message' => 'Update Failed!']
            );
        }
    }

    public function destroy($id)
    {
        // dd($teacher->course->all());
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return [
            'message' => 'delete successfull',
        ];
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
