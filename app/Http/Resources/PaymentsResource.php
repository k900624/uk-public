<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
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
            'type'        => 'paiments',
            'id'          => $this->id,
            'amount'      => $this->amount,
            'balance'     => $this->balance,
            'operation'   => $this->operation,
            'description' => $this->description,
            'created_at'  => $this->created_at,
        ];
    }
}
