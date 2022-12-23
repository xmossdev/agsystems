<?php

namespace App\Filters;

class CompareNumberFilter
{
    public function handle($query, $next, $column)
    {
        if (request()->filter) {
            if (isset(request()->filter['compare'][$column])) {
                $sign = substr(request()->filter['compare'][$column], 0, 1);
                if (in_array($sign, ['=', '>', '<'])) {
                    $value = substr(request()->filter['compare'][$column], 1, strlen(request()->filter['compare'][$column]));
                    $query->where($column, $sign, $value);
                }
            }
        }
        return $next($query);
    }
}
