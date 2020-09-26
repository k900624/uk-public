<?php

namespace App\Observers\Admin;

use App\Models\Page;

class PageObserver
{
    /**
     * Handle the shop product "creating" event.
     *
     * @param Page $page
     * @return void
     */
    public function creating(Page $page)
    {
        $this->setAlias($page);
    }
    
    /**
     * Handle the page "created" event.
     *
     * @param  Page $page
     * @return void
     */
    public function created(Page $page)
    {
        //
    }
    
    /**
     * Handle the shop product "updating" event.
     *
     * @param  Page $page
     * @return void
     */
    public function updating(Page $page)
    {
        $this->setAlias($page);
    }

    /**
     * Handle the page "updated" event.
     *
     * @param  Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param  Page $page
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }

    /**
     * Handle the page "restored" event.
     *
     * @param  Page $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param  Page $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
    
    public function setAlias(Page $page)
    {
        if (isset($page->id)) {
            $id = $page->id;
        } else {
            $id = get_autoincrement('content');
        }

        if (empty($page->alias)) {
            $page->alias = \Str::slug($page->title) .'-'. $id;
        } else {
            $page->alias = \Str::slug($page->alias);
        }
    }
}
