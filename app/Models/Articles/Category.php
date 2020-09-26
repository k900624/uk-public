<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const UPDATED_AT = null;
    
    protected $fillable = [
        'id',
        'parent_id',
        'title',
        'alias',
        'image',
        'description',
        'created_at',
        'created_by',
        'metakey',
        'metadesc',
        'ordering',
        'published',
    ];
    
    /*public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }*/
}
