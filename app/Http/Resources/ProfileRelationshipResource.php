<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileRelationshipResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'avatar'         => $this->avatar,
            'phone'          => $this->phone,
            'phone2'         => $this->phone2,
            'phone_verified' => $this->phone_verified,
            'vkontakte'      => $this->vkontakte,
            'facebook'       => $this->facebook,
            'twitter'        => $this->twitter,
            'odnoklassniki'  => $this->odnoklassniki,
            'telegram'       => $this->telegram,
        ];
    }
}
