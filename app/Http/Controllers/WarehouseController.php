<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\IndexRequest;
use App\Http\Requests\Warehouse\StoreRequest;
use App\Http\Requests\Warehouse\UpdateRequest;
use App\Http\Requests\Warehouse\ValidIdRequest;
use App\Services\WarehouseService;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    protected WarehouseService $service;

    public function __construct()
    {
        $this->service = new WarehouseService();
    }

    public function index(IndexRequest $request): JsonResponse
    {
        try {
            $collWarehouses = $this->service->getAllWithFilters();
            return createResponse($collWarehouses);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $objWarehouses = $this->service->create($request->validated());
            return createResponse($objWarehouses);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }

    public function show(ValidIdRequest $request, int $id): JsonResponse
    {
        try {
            $objWarehouse = $this->service->get($id);
            return createResponse($objWarehouse);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            $objWarehouses = $this->service->update($request->validated());
            return createResponse($objWarehouses);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }

    public function destroy(ValidIdRequest $request, int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return createResponse(['OK']);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }
}
