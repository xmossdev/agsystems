<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ItemService
{
    public function getAllWithFilters(): Collection
    {
        return Item::query()->filter([
            '\App\Filters\StringFilter:name',
            '\App\Filters\InWarehouseFilter',
            '\App\Filters\CompareNumberFilter:price',
            '\App\Filters\TotalCountFilter',
            '\App\Filters\PaginateFilter',
        ])->get();
    }

    public function create(array $request): Item
    {
        $item = Item::firstOrCreate(Arr::except($request, ['warehouse_id', 'count']));
        /** @var Warehouse $warehouse */
        $warehouse = Warehouse::find($request['warehouse_id']);
        $warehouse->items()->sync([
            $item->id => ['count' => $request['count'] + $warehouse->getItemCount($item->id)]
        ]);
        return $this->get($item->id);
    }

    public function get(int $id): ?Item
    {
        return Item::find($id);
    }

    public function update(array $request): Item
    {
        $objItem = Item::where('id', $request['id'])->first();
        $objItem->update(Arr::except($request, ['warehouse_id', 'count']));
        if (isset($request['warehouse_id'])) {
            $objItem->warehouses()->syncWithoutDetaching([
                $request['warehouse_id'] => [
                    'count' => $request['count']
                ]
            ]);
        }
        return $objItem->refresh();
    }

    public function delete(int $id): void
    {
        Item::where('id', $id)->delete();
    }
}
