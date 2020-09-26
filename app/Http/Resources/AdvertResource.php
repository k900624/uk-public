<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
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
            'type'       => 'adverts',
            'id'         => $this->id,
            'attributes' => [
                'title'         => $this->title,
                'autor'         => $this->user->name,
                'created_at'    => $this->created_at,
                'alias'         => $this->alias,
                'image'         => ($this->image)
                                       ? url('storage/'. $this->image)
                                       : null,
                'introtext'     => ($this->introtext)
                                       ? html_decode($this->introtext)
                                       : \Str::limit(strip_tags(html_decode($this->fulltext)), 300),
                'fulltext'      => html_decode($this->fulltext),
            ],
        ];
    }
}
