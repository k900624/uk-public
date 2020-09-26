<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use YoHang88\LetterAvatar\LetterAvatar;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'       => 'users',
            'id'         => $this->id,
            'attributes' => [
                'name'      => $this->name,
                'email'     => $this->email,
                'main_user' => $this->areas[0]->pivot->main,
            ],
        ];
    }

    public function with($request)
    {
        $hasProfile = $request->profile ? $request->profile : false;

        $profile = $this->profile;
        $profile->phone_verified = ! is_null($profile->phone_verified_at);

        if ($hasProfile) {
            return [
                'profile' => new ProfileRelationshipResource($profile)
            ];
        }
        return [];
    }
}
