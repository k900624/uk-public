<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Image\ImageFacade as ImageThumb;

class ArticleResource extends JsonResource
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
            'type'       => 'news',
            'id'         => $this->id,
            'attributes' => [
                'title'          => $this->title,
                'autor'          => $this->user->name,
                'created_at'     => $this->created_at,
                'category_title' => $this->category->title,
                'category_alias' => $this->category->alias,
                'alias'          => $this->alias,
                'image'          => ($this->image)
                                       ? '/storage/'. $this->image
                                       : null,
                'image_thumb'    => ($this->image)
                                       ? ImageThumb::get($this->image, 'articles', 100)
                                       : null,
                'introtext'      => ($this->introtext)
                                       ? html_decode($this->introtext)
                                       : \Str::limit(strip_tags(html_decode($this->fulltext)), 300),
                'fulltext'       => html_decode($this->fulltext),
            ],
            'links'         => [
                'self' => route('api.news.show', ['alias' => $this->alias]),
                'related_category' => route('api.news.category.show', ['alias' => $this->category->alias]),
            ],
        ];
    }
}
