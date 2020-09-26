<?php

namespace App\Observers\Admin;

use App\Models\Articles\Article;

class ArticleObserver
{
    /**
     * Handle the shop product "creating" event.
     *
     * @param Article $article
     * @return void
     */
    public function creating(Article $article)
    {
        $this->setAlias($article);
    }
    
    /**
     * Handle the page "created" event.
     *
     * @param  Article $article
     * @return void
     */
    public function created(Article $article)
    {
        //
    }
    
    /**
     * Handle the shop product "updating" event.
     *
     * @param  Article $article
     * @return void
     */
    public function updating(Article $article)
    {
        $this->setAlias($article);
    }

    /**
     * Handle the page "updated" event.
     *
     * @param Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param  Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the page "restored" event.
     *
     * @param  Article $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param  Article $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
    
    public function setAlias(Article $article)
    {
        if (isset($article->id)) {
            $id = $article->id;
        } else {
            $id = get_autoincrement('content');
        }

        if (empty($article->alias)) {
            $article->alias = \Str::slug($article->title) .'-'. $id;
        } else {
            $article->alias = \Str::slug($article->alias);
        }
    }
}
