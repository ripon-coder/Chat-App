<?php

namespace App\Services\Filters;

class NameFilter
{
    public function handle($payload, $next)
    {
        $query = $payload['query'];
        $filterData = $payload['filter'] ?? [];

        if (! empty($filterData['name'])) {
            $query->where('name', 'like', '%'.$filterData['name'].'%');
        }

        $payload['query'] = $query;

        return $next($payload);
    }
}
