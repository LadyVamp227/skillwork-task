<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\ArticlesServiceAdapter;
use App\Models\Article;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class ArticlesService implements ArticlesServiceAdapter
{

    public function create(array $data) : string
    {
        $article = new Article;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->user()->associate(Auth::id());
        $article->save();
        return "okey";
    }

    public function show() : CursorPaginator
    {
        return Article::leftJoin('users', 'users.id', '=', 'author')->select(
            'articles.title',
            'users.name',
            'articles.created_at',
            'articles.updated_at'
        )->orderBy('articles.id')->cursorPaginate(5);
    }

    public function byId(int $id) : Collection
    {
        return Article::where('id', $id)->get();
    }
}
