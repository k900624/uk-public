<?php

namespace App\Http\Controllers\Api;

use App\Models\Users\User;
use App\Models\Abuse;
use Illuminate\Http\Request;
use App\Http\Resources\AbuseResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AbuseController extends ApiController
{
    public function store(Request $request)
    {
        $rules = [
            'abuse' => 'required|string|min:10|max:500',
            'subject' => 'required|string',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        if ($user) {
            $abuse = new Abuse;
            $abuse->user_id = $user->id;
            $abuse->name    = $user->name;
            $abuse->email   = $user->email;
            $abuse->text    = $request->abuse;
            $abuse->subject = $request->subject;

            if ($abuse->save()){
                return (new AbuseResource($abuse))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
            }
        }
    }
}
