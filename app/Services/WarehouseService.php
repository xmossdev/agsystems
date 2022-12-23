<?php

namespace App\Services;

use App\Models\Warehouse;

use Illuminate\Support\Collection;

class WarehouseService
{
    public function getAllWithFilters(): Collection
    {
        return Warehouse::query()->filter([
            '\App\Filters\StringFilter:name',
            '\App\Filters\StringFilter:code',
            '\App\Filters\PaginateFilter',
        ])->get();
    }

    public function create(array $request): Warehouse
    {
        return Warehouse::create($request);
    }

    public function get(int $id): ?Warehouse
    {
        return Warehouse::find($id);
    }

    public function update(array $request): Warehouse
    {
        $objWarehouse = Warehouse::where('id', $request['id'])->first();
        $objWarehouse->update($request);
        return $objWarehouse->refresh();
    }

    public function delete(int $id): void
    {
        Warehouse::where('id', $id)->delete();
    }
}
