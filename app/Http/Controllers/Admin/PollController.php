<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\PollRepository;
use App\Models\Polls\Poll;
use Carbon\Carbon;

class PollController extends BaseController
{
    protected $pollRepo;

    public function __construct(PollRepository $pollRepo)
    {
        parent::__construct();
        
        $this->pollRepo = $pollRepo;

        view()->share(['heading' => 'Голосования', 'title' => 'Список голосований']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $data['polls'] = $this->pollRepo->getPollsPagination($perPage);
        $data['countPolls'] = $this->pollRepo->getCountPolls();

        return view('admin.polls.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poll = new Poll();
        $poll->created_at = Carbon::now();
        $poll->started_at = Carbon::now()->toDateString();
        $poll->ended_at = Carbon::now()->addDays(2)->toDateString();

        $data['action'] = route('admin.polls.store');
        $data['poll'] = $poll;

        return view('admin.polls.form', $data)->with(['title' => 'Создание голосования']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll = $this->pollRepo->getId($id);

        $this->recordExists($poll);
        
        $data['poll'] = $poll;
        $data['action'] = route('admin.polls.update', $id);

        return view('admin.polls.form', $data)->with(['title' => 'Редактирование голосования']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
