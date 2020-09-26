<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'id',
        'question',
        'answer',
        'cat_id',
        'name',
        'email',
        'created_at',
        'published',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\FaqCategory', 'cat_id'); //Прямая связь
    }
}
