<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'alias',
        'cat_id',
        'introtext',
        'fulltext',
        'image',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'published',
        'enable_comments',
        'metakey',
        'metadesc'
    ];

    protected $table = 'content';

    public function category()
    {
        return $this->belongsTo('App\Models\Articles\Category', 'cat_id'); //Прямая связь
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'created_by'); //Прямая связь
    }

}
