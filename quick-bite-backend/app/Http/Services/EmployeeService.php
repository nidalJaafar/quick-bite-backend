<?php

namespace App\Http\Services;

use App\Http\Mappers\EmployeeMapper;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
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
        $employee->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteEmployee(Employee $employee)
    {
        $employee->deleteOrFail();
    }
}
