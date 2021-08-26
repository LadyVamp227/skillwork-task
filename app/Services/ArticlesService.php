<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticlesServiceAdapter;
use App\Models\Article;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

final class ArticlesService implements ArticlesServiceAdapter
{

    public function create(Collection $data) : ArticleResource
    {
        $article = new Article;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->user()->associate(Auth::id());
        $article->save();
        return new ArticleResource($article);
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

    public function byId(int $id) : ArticleResource
    {
        return new ArticleResource(Article::findOrFail($id));
    }
}
