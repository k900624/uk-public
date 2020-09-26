<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'key'   => $this->key,
            'value' => isset($this->pivot->setting_value) ? $this->pivot->setting_value : $this->value,
            // 'type'       => 'settings',
            // 'id'         => $this->id,
            // 'attributes' => [
            //     'description' => $this->description,
            //     'key'         => $this->key,
            //     'value'       => $this->value,
            // ],
        ];
    }
}
