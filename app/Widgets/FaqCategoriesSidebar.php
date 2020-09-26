<?php

namespace App\Widgets;

use App\Repositories\Front\FaqRepository;
use Arrilot\Widgets\AbstractWidget;

class FaqCategoriesSidebar extends AbstractWidget
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
     * @param FaqRepository $faqRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(FaqRepository $faqRepository)
    {
        $categories = $faqRepository->getCategories();

        return view('widgets.faq_categories_sidebar', [
            'categories' => $categories
        ]);
    }
}
