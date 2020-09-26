<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\ServiceRequestResource;
use App\Models\ServiceRequest;
use App\Models\Users\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $areaId = $this->getAreaId($request);

        $services = ServiceRequest::where([
                'service_requests.area_id' => $areaId,
            ])->latest()->get();

        return ServicesResource::collection($services);
    }

    public function serviceRequests(Request $request)
    {
        $areaId = $this->getAreaId($request);

        $servicesRequest = ServiceRequest::where([
                'service_requests.area_id' => $areaId,
            ])->latest()->get();

        return ServiceRequestResource::collection($servicesRequest);
    }

    public function store(Request $request)
    {
        $rules = [
            'requestText' => 'required|string|min:10|max:500',
            'token'       => 'required',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $areaId = $this->getAreaId($request);

        if ($areaId) {
            $requestData = new ServiceRequest();
            $requestData->description = $request->requestText;
            $requestData->area_id = $areaId;

            if ($requestData->save()) {
                return (new ServiceRequestResource($requestData))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
            }
        }
    }

    private function getAreaId(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $area = $user->areas;

        return $area[0]->id;
    }
}
