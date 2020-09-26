<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Front\PageRepository;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;

class PageController extends ApiController
{
    protected $pageRepo;

    public function __construct(PageRepository $pageRepo)
    {
        parent::__construct();

        $this->pageRepo = $pageRepo;
    }

    public function show($alias = null)
    {
        $page = $this->pageRepo->getPage($alias);

        return new PageResource($page);
    }

    public function bad_browser()
    {
        return view('pages.bad_browser');
    }

}
