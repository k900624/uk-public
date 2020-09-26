<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use YoHang88\LetterAvatar\LetterAvatar;

class AreaResource extends JsonResource
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
            'type'       => 'area',
            'id'         => $this->id,
            'attributes' => [
                'address'            => $this->address,
                'contract_number'    => $this->contract_number,
                'contract_date'      => $this->contract_date,
                'contract_file'      => $this->contract_file,
                'land_area'          => $this->land_area,
                'house_area'         => $this->house_area,
                'quantity_residents' => $this->quantity_residents,
                'сounters'           => json_decode($this->сounters),
            ],
        ];
    }

    public function with($request)
    {
        return [];
    }
}
