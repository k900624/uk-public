<?php

namespace App\Http\Controllers\Api;

use App\Models\Users\User;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\Front\Users\UsersEditRequest;
use App\Http\Resources\UserResource;
use App\Services\Image\Image;
use YoHang88\LetterAvatar\LetterAvatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request)
    {
        $rules = [
            'user.phone'         => 'required|string',
            'user.phone2'        => 'required|string',
            'user.vkontakte'     => 'string|nullable',
            'user.odnoklassniki' => 'string|nullable',
            'user.facebook'      => 'string|nullable',
            'user.twitter'       => 'string|nullable',
            'user.telegram'      => 'string|nullable',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        if ($request->password_new) {
            $user->password = Hash::make($request->password_new);
        }

        $profileFound = Profile::findOrFail($user->id);

        $profile = $profileFound ? $profileFound : new Profile;
        $profile->user_id       = $user->id;
        $profile->phone         = filter_title($request->user['phone']);
        $profile->phone2        = filter_title($request->user['phone2']);
        $profile->vkontakte     = trim(remove_http(filter_title($request->user['vkontakte'])), '/');
        $profile->facebook      = trim(remove_http(filter_title($request->user['facebook'])), '/');
        $profile->twitter       = trim(remove_http(filter_title($request->user['twitter'])), '/');
        $profile->odnoklassniki = trim(remove_http(filter_title($request->user['odnoklassniki'])), '/');
        $profile->telegram      = trim(remove_http(filter_title($request->user['telegram'])), '/');

        if ($user->save() && $profile->save()) {
            return new UserResource($user);
        }
    }

    public function show(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        // UserResource::withoutWrapping();
        return new UserResource($user);
    }

    public function avatarStore(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if (request()->hasFile('file')) {
            $image = new Image();
            $path = $image->thumbs(request()->file('file'), 'avatars');

            $user->profile->update([
                'avatar' => $path,
            ]);

            $result = [
                'status' => 'success',
                'url' => $path,
            ];
            return response()->json($result);

        } elseif (request()->imageLoaded == 'false') {

            Storage::disk('public')->delete($user->image);

            $user->profile->update([
                'avatar' => null,
            ]);
        }
    }
}
