<?php

namespace App\Http\Controllers\Admin;

use App\Models\Abuse;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\AbuseRepository;
use App\Services\ResponseLib;

class AbuseController extends BaseController
{
    protected $abuseRepo;
    
    public function __construct(AbuseRepository $abuseRepo)
    {
        parent::__construct();
        
        $this->abuseRepo = $abuseRepo;

        view()->share(['heading' => 'Претензии', 'title' => 'Список претензий']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $data['abuses'] = $this->abuseRepo->getAbusesPagination($perPage);
        $data['countAbuses'] = $this->abuseRepo->getCountAbuses();

        return view('admin.abuses.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id)
    {
        if (request()->ajax()) {

            $abuse = $this->abuseRepo->getAbuse($id);

            if ($abuse) {

                $data['abuse'] = $abuse;

                $response = new ResponseLib();

                $response->dialog([
                    "title" => "Просмотр претензии",
                    "body" => view("admin.abuses.modal_details", $data)->render(),
                    "size" => "default",
                ]);
                $response->send();

            } else {
                $this->notify->error('Такой претензии не существует');
            }

        } else {
            return response()->json('error', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $abuse = $this->abuseRepo->getId($id);
        
        $this->recordExists($abuse);
        
        $result = Abuse::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил претензию от &laquo;'. trim($abuse->name, '&raquo; &laquo;') .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Претензия удалена', 'error' => 'Ошибка удаления']);
    }

}
