<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AreaRelationshipResource extends Resource
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
            'profile' => [
                'address' => $this->address,
            ]
        ];
    }
}
