<?php

namespace App\Observers\Admin;

use App\Models\Articles\Category;

class CategoryObserver
{
    /**
     * Handle the shop category "creating" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $this->setAlias($category);
    }

    /**
     * Handle the shop category "created" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the shop category "updating" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        $this->setAlias($category);
    }

    /**
     * Handle the shop category "updated" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the shop category "deleted" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the shop category "restored" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the shop category "force deleted" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }

    public function setAlias(Category $category)
    {
        if (isset($category->id)) {
            $id = $category->id;
        } else {
            $id = get_autoincrement('categories');
        }

        if (empty($category->alias)) {
            $category->alias = \Str::slug($category->title) .'-'. $id;
        } else {
            $category->alias = \Str::slug($category->alias);
        }
    }
}
