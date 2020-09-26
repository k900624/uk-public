<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'id',
        'title',
        'alias',
        'fulltext',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'published',
        'metakey',
        'metadesc'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Articles\Category', 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'created_by');
    }
}
