<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type'       => 'news_categories',
            'id'         => $this->id,
            'attributes' => [
                'title' => $this->title,
                'alias' => $this->alias,
                'articles_count' => $this->articles_count,
            ],
            'links'      => [
                'self' => route('api.news.category.show', ['alias' => $this->alias]),
            ],
        ];
    }
}
