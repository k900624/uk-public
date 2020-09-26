<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Faq as Model;
use \DB;

class FaqRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllFaq($perPage)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->latest()
            ->paginate($perPage);

        return $result;
    }

    public function getCategoryFaq($perPage, $cat_id)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->latest()
            ->where('cat_id', $cat_id)
            ->paginate($perPage);

        return $result;
    }

    public function getCountFaq()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

    public function getCountCategoryFaq($cat_id)
    {
        $result = $this
            ->startConditions()
            ->where('cat_id', $cat_id)
            ->get()
            ->count();

        return $result;
    }

    public function getFaqCategories()
    {
        $result = DB::table('faq_category')
            ->get();

        return $result;
    }

    public function checkUniqueCategoryTitle($title)
    {
        $result = DB::table('faq_category')
            ->where('title', $title)
            ->exists();

        return $result;
    }

    public function getCategoryId($id)
    {
        $result = DB::table('faq_category')
            ->where('id', $id)
            ->first();

        return $result;
    }

}