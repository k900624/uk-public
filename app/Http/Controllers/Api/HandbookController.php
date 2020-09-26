<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Articles\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticlesResource;

class HandbookController extends ApiController
{
    public function index(Request $request)
    {
        $perPage = 10;
        $limit = $request->paginate ? $request->paginate : $perPage;
        $orderBy = $request->orderBy ? $request->orderBy : 'desc';
        $sortBy = $request->sortBy ? $request->sortBy : 'content.created_at';

        $articles = Article::where([
                ['cat_id', '=', 6],
                ['published', '=', '1'],
            ])
            ->orderBy($sortBy, $orderBy)
            ->limit($limit)
            ->paginate($limit);

        return ArticleResource::collection($articles);
    }

    public function home(Request $request)
    {
        $perPage = 5;
        $limit = $request->paginate ? $request->paginate : $perPage;
        $orderBy = $request->orderBy ? $request->orderBy : 'desc';
        $sortBy = $request->sortBy ? $request->sortBy : 'content.created_at';

        $articles = Article::where([
                ['cat_id', '=', 6],
                ['published', '=', '1'],
            ])
            ->orderBy($sortBy, $orderBy)
            ->limit($limit)
            ->paginate($limit);

        return ArticleResource::collection($articles);
    }

    public function show($alias)
    {
        $article = Article::where([
                ['cat_id', '=', 6],
                ['published', '=', '1'],
                ['alias', '=', $alias],
            ])->firstOrFail();

        return new ArticleResource($article);
    }
}
