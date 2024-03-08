<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class BaseService
{
    public function paginate($data, $perPage, $page)
    {
        $currentPageItems = collect($data)->slice(($page - 1) * $perPage, $perPage)->all();

        return new LengthAwarePaginator($currentPageItems, count($data), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }
}
