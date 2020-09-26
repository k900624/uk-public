<?php

namespace App\Http\Controllers\Api;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Resources\AreaResource;
use Illuminate\Support\Facades\Auth;

class AreaController extends ApiController
{
    public function show(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $area = $user->areas;

        AreaResource::withoutWrapping();
        return new AreaResource($area[0]);
    }
}
