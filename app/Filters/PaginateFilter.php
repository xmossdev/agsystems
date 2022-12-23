<?php

namespace App\Filters;

class PaginateFilter
{
    public function handle($query, $next)
    {
        if (request()->filter) {
            if (isset(request()->filter['page']) && isset(request()->filter['perPage'])) {
                $query->skip(
                    request()->filter['page'] * request()->filter['perPage']
                )->take(request()->filter['perPage']);
            }
        }
        return $next($query);
    }
}
