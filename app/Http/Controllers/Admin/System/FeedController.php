<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Repositories\Admin\FeedRepository;
use App\Http\Controllers\Admin\BaseController;
use \DB;

class FeedController extends BaseController
{
    protected $feedRepo;
    
    public function __construct(FeedRepository $feedRepo)
    {
        parent::__construct();
        
        $this->feedRepo = $feedRepo;

        view()->share(['heading' => 'Журнал событий', 'title' => 'Журнал событий']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        
        $feeds = $this->feedRepo->getAllFeeds($perPage);
        $countFeeds = $this->feedRepo->getCountFeeds();
        
        $data['feeds'] = $feeds;
        $data['countFeeds'] = $countFeeds;

        return view('admin.system.feed.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        DB::table('activities')->truncate();

        $this->notify->success('Все события удалены');
        
        return back()->withInput();
    }
}
