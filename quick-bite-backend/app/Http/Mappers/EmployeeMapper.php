<?php

namespace App\Http\Mappers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeMapper
{

    public function employeeRequestToEmployee(EmployeeRequest $request): Employee
    {
        $employee = new Employee();
        $employee->full_name = $request->full_name;
        $employee->image = $request->image;
        $employee->position = $request->position;
        $employee->fb_link = $request->fb_link;
        $employee->twitter_link = $request->twitter_link;
        $employee->ig_link = $request->ig_link;
        return $employee;
    }
}
