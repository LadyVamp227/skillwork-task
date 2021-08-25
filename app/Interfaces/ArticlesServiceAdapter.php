<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface ArticlesServiceAdapter
{
    public function create(Collection $data) : ArticleResource;

    public function show() : CursorPaginator;

    public function byId(int $id) : ArticleResource;
}
