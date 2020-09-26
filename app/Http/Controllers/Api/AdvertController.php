<?php

namespace App\Http\Controllers\Api;

use App\Models\Articles\Article;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertResource;

class AdvertController extends ApiController
{
    public function index()
    {
        $perPage = 3;

        $articles = Article::where([
                ['cat_id', '=', 2],
                ['published', '=', '1']
            ])
            ->latest()
            ->limit($perPage)
            ->get();

        return AdvertResource::collection($articles);
    }

    public function paginate(Request $request)
    {
        $perPage = 3;
        $limit = $request->paginate ? $request->paginate : $perPage;
        $orderBy = $request->orderBy ? $request->orderBy : 'desc';
        $sortBy = $request->sortBy ? $request->sortBy : 'content.created_at';

        $articles = Article::where([
                ['cat_id', '=', 2],
                ['published', '=', '1']
            ])
            ->orderBy($sortBy, $orderBy)
            ->limit($limit)
            ->paginate($limit);

        return AdvertResource::collection($articles);
    }

    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

}
