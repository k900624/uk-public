<?php

namespace App\Http\Controllers\Admin\Services;

use App\Models\Service;
use App\Repositories\Admin\ServiceRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseLib;
use App\Http\Controllers\Admin\BaseController;

class ServiceController extends BaseController
{
    protected $serviceRepo;
    
    public function __construct(ServiceRepository $serviceRepo)
    {
        parent::__construct();
        
        $this->serviceRepo = $serviceRepo;

        view()->share(['heading' => 'Услуги', 'title' => 'Список услуг']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectGroup = $request->group;

        $perPage = 20;
        if ( ! $selectGroup) {
            $services = $this->serviceRepo->getServicesPagination($perPage);
            $countServices = $this->serviceRepo->getCountServices();
        } else {
            $services = $this->serviceRepo->getGroupServices($perPage, $selectGroup);
            $countServices = $this->serviceRepo->getCountGroupServices($selectGroup);
        }
        
        $data['services'] = $services;
        $data['servicesGroups'] = $this->serviceRepo->getGroups();
        $data['countServices'] = $countServices;
        $data['selectGroup'] = $selectGroup;

        return view('admin.services.index', $data);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $service = new Service();
        $service->created_at = date('Y-m-d H:i:s');

        $data['servicesGroups'] = $this->serviceRepo->getGroups();
        $data['action'] = route('admin.services.store');
        $data['selectGroup'] = $request->group;
        $data['service'] = $service;

        return view('admin.services.form', $data)->with(['title' => 'Создание услуги']);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title      = $request->title;
        $page->alias      = $request->alias;
        $page->fulltext   = $request->fulltext;
        $page->metakey    = $request->metakey;
        $page->metadesc   = $request->metadesc;
        $page->published  = $request->published;
        $page->created_at = $request->created_at;
        $page->created_by = Auth::user()->id;
        $page->save();
        
        if ($page) {
            $this->setFeed('Добавил страницу <a href="'. route('admin.pages.edit', $page->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($page, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.pages.index'));
    }
}
