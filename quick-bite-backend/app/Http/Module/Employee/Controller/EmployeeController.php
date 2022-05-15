<?php

namespace App\Http\Module\Employee\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Employee\Request\EmployeeRequest;
use App\Http\Module\Employee\Service\EmployeeService;
use App\Models\Employee;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;
use function response;

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
    public function index(): JsonResponse
    {
        return response()->json(['employees' => $this->service->getEmployees()]);
    }

    /**
     * Display a listing of the resource image.
     *
     * @return StreamedResponse
     */
    public function showImage(Employee $employee): StreamedResponse
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
    public function store(EmployeeRequest $request): JsonResponse
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
    public function show(Employee $employee): JsonResponse
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
    public function update(EmployeeRequest $request, Employee $employee): JsonResponse
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
    public function destroy(Employee $employee): JsonResponse
    {
        $this->authorize('delete', $employee);
        $this->service->deleteEmployee($employee);
        return response()->json(status: 204);
    }
}
