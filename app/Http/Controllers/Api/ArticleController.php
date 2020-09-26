<?php

namespace App\Http\Controllers\Api;

use App\Models\Articles\Article;
use App\Models\Articles\Category;
use App\Repositories\Front\Article\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticlesResource;
use App\Http\Resources\CategoryResource;

class ArticleController extends ApiController
{
    public function index(Request $request)
    {
        $perPage = 3;
        $limit = $request->paginate ? $request->paginate : $perPage;
        $orderBy = $request->orderBy ? $request->orderBy : 'desc';
        $sortBy = $request->sortBy ? $request->sortBy : 'content.created_at';

        $articles = Article::where([
                ['cat_id', '!=', 0],
                ['cat_id', '!=', 2],
                ['cat_id', '!=', 6],
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
                ['cat_id', '!=', 0],
                ['cat_id', '!=', 2],
                ['cat_id', '!=', 6],
                ['published', '=', '1'],
                ['alias', '=', $alias],
            ])->firstOrFail();

        return new ArticleResource($article);
    }

    public function category(Request $request, $alias)
    {
        $perPage = 3;
        $limit = $request->paginate ? $request->paginate : $perPage;
        $orderBy = $request->orderBy ? $request->orderBy : 'desc';
        $sortBy = $request->sortBy ? $request->sortBy : 'content.created_at';

        $category = Category::where('alias', $alias)->firstOrFail();

        $articles = Article::where([
                'categories.alias' => $alias,
                'content.published' => '1',
            ])
            ->select(
                'content.*'
            )
            ->join('categories', 'categories.id', '=', 'content.cat_id', 'left')
            ->orderBy($sortBy, $orderBy)
            ->limit($limit)
            ->paginate($limit);

        return (new ArticlesResource($articles))
                ->additional(['relationships' => [
                    'category' => [
                        'title' => $category->title
                    ],
                ]]);
        // return ArticleResource::collection($articles);
    }

    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getCategoriesWithCounts();

        return CategoryResource::collection($categories);
    }

}
