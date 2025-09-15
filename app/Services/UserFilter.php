<?php

namespace App\Services;

class UserFilter extends BaseFilter
{
    protected function getFilters()
    {
        return [
            Filters\NameFilter::class,
            Filters\EmailFilter::class,
        ];
    }
}
