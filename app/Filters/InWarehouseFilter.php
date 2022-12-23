<?php

namespace App\Filters;


class InWarehouseFilter
{
    public function handle($query, $next)
    {
        if (request()->filter) {
            if (isset(request()->filter['warehouse'])) {
                $warehouseId = request()->filter['warehouse'];
                $query->whereHas('warehouses', function ($subQuery) use ($warehouseId) {
                    $subQuery->where('warehouse_id', $warehouseId);
                });
            }
        }
        return $next($query);
    }
}
