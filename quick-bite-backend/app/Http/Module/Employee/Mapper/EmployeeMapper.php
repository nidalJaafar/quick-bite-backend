<?php

namespace App\Http\Module\Employee\Mapper;

use App\Http\Module\Employee\Request\EmployeeRequest;
use App\Models\Employee;

class EmployeeMapper
{

    public function employeeRequestToEmployee(EmployeeRequest $request): Employee
    {
        return new Employee($request->all());
    }
}
