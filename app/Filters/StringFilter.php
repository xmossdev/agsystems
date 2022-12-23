<?php

namespace App\Filters;

class StringFilter
{
    public function handle($query, $next, $column)
    {
        if (request()->filter) {
            if (isset(request()->filter[$column]))
                $query->where($column, 'LIKE', request()->filter[$column] . '%');
        }

        return $next($query);
    }
}
