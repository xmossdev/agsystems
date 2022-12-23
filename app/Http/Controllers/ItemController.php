<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\IndexRequest;
use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Http\Requests\Item\ValidIdRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{

    protected ItemService $service;

    public function __construct()
    {
        $this->service = new ItemService();
    }

    public function index(IndexRequest $request): JsonResponse
    {
        try {
            $collItems = $this->service->getAllWithFilters();
            return createResponse($collItems);
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
            $objItem = $this->service->get($id);
            return createResponse($objItem);
        } catch (\Exception $e) {
            return createErrorResponse($e);
        }
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        try {
            $objItem = $this->service->update($request->validated());
            return createResponse($objItem);
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
