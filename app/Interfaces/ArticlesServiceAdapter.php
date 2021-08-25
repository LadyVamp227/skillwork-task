<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Article;
use Illuminate\Contracts\Pagination\CursorPaginator;

interface ArticlesServiceAdapter
{
    public function create(array $data) : string;

    public function show() : CursorPaginator;

    public function byId(int $id) : Article;
}
