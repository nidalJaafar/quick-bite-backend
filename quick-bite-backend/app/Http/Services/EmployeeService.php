<?php

namespace App\Http\Services;

use App\Http\Mappers\EmployeeMapper;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class EmployeeService
{
    private EmployeeMapper $mapper;

    public function __construct(EmployeeMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @throws Throwable
     */
    public function createEmployee(EmployeeRequest $request)
    {
        $fileName = time() . '__' . $request->file('image')->getClientOriginalName();
        $request->image = $fileName;
        $request->file('image')->storeAs('public/images/employees', $fileName);
        $this->mapper->employeeRequestToEmployee($request)->saveOrFail();
    }

    public function getEmployee(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee);
    }

    public function getEmployees(): EmployeeCollection
    {
        return new EmployeeCollection(Employee::all());
    }

    /**
     * @throws Throwable
     */
    public function updateEmployee(EmployeeRequest $request, Employee $employee)
    {
        if ($request->image != $employee->image) {
            Storage::delete('public/images/employees/' . $employee->image);
            $fileName = time() . '__' . $request->file('image')->getClientOriginalName();
            $request->image = $fileName;
            $request->file('image')->storeAs('public/images/employees', $fileName);
        }
        $employee->updateOrFail($request->all());
    }

    public function getEmployeeImage(Employee $employee): StreamedResponse
    {
        return Storage::download('public/images/employees/' . $employee->image);

    }

    /**
     * @throws Throwable
     */
    public function deleteEmployee(Employee $employee)
    {
        Storage::delete('public/images/employees/' . $employee->image);
        $employee->deleteOrFail();
    }
}
