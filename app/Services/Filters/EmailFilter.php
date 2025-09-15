<?php

namespace App\Services\Filters;

class EmailFilter
{
    public function handle($payload, $next)
    {
        $query = $payload['query'];
        $filterData = $payload['filter'] ?? [];

        if (! empty($filterData['email'])) {
            $query->where('email', 'like', '%'.$filterData['email'].'%');
        }

        $payload['query'] = $query;

        return $next($payload);
    }
}
