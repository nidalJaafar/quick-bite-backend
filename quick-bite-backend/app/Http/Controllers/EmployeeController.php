<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Services\EmployeeService;
use App\Models\Employee;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class EmployeeController extends Controller
{
    private EmployeeService $service;

    /**
     * @param EmployeeService $service
     */
    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['employees' => $this->service->getEmployees()]);
    }

    /**
     * Display a listing of the resource image.
     *
     * @return StreamedResponse
     */
    public function showImage(Employee $employee)
    {
        return $this->service->getEmployeeImage($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function store(EmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);
        $this->service->createEmployee($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee)
    {
        return response()->json(['employee' => $this->service->getEmployee($employee)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update', $employee);
        $this->service->updateEmployee($request, $employee);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);
        $this->service->deleteEmployee($employee);
        return response()->json(status: 204);
    }
}
