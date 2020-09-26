<?php

namespace App\Repositories\Admin\Articles;

use App\Repositories\CoreRepository;
use App\Models\Articles\Tag as Model;
use \DB;

class TagRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllTags()
    {
        $result = $this
            ->startConditions()
            ->latest()
            ->get();

        return $result;
    }
    
    public function getTagsArticle($id)
    {
        $result = DB::table('tags_content')
            ->join('tags', 'tags.id', '=', 'tags_content.tag_id', 'left')
            ->where([
                'object_name' => 'articles',
                'object_id'   => $id,
            ])
            ->get();

        return $result;
    }
    
}