<?php

namespace App\Widgets;

use App\Repositories\Front\Article\CategoryRepository;
use Arrilot\Widgets\AbstractWidget;

class ArticlesCategoriesSidebar extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getCategoriesWithCounts();

        return view('widgets.articles_categories_sidebar', [
            'categories' => $categories
        ]);
    }
}
