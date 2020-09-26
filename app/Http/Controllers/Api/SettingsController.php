<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Models\Users\User;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends ApiController
{
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $defaultSettings = Setting::where('type', 'user')->get();

        $settings = $user->settings;

        $mergedSettings = $defaultSettings->merge($settings);

        return SettingsResource::collection($mergedSettings);
    }

    public function store(Request $request)
    {
        $rules = [
            'user_notification_time_from' => 'string|nullable',
            'user_notification_time_to'   => 'string|nullable',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        if ($user) {

            foreach ($request->settings as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                $user->settings()->detach($setting);
                $user->settings()->save($setting, ['setting_value' => $value]);
            }
            $settings = $user->settings;
            // dd($settings);
            return SettingsResource::collection($settings);
        }
    }
}
