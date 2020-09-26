<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'type'       => 'pages',
            'id'         => $this->id,
            'attributes' => [
                'title'          => $this->title,
                'autor'          => $this->user->name,
                'created_at'     => $this->created_at,
                'alias'          => $this->alias,
                'fulltext'       => html_decode($this->fulltext),
            ],
            'links' => [
                'self' => route('api.page.show', ['alias' => $this->alias]),
            ],
        ];
    }
}
