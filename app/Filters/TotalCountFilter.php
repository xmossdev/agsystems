<?php

namespace App\Filters;

class TotalCountFilter
{
    public function handle($query, $next)
    {
        if (request()->filter) {
            if (isset(request()->filter['count'])) {
                $filter = request()->filter;
                $query->whereHas('warehouses', function ($subQuery) use ($filter) {
                    $sign = substr($filter['count'], 0, 1);
                    if (in_array($sign, ['=', '>', '<'])) {
                        $value = substr($filter['count'], 1, strlen($filter['count']));
                        if (isset($filter['warehouse'])) {
                            $subQuery->whereRaw('warehouse_id =' . $filter['warehouse']);
                        }
                        $subQuery->select(\DB::raw('SUM(count) as total'))
                            ->havingRaw('total' . $sign . $value);
                    }
                });
            }
        }
        return $next($query);
    }
}
