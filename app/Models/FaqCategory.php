<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faq_category';

    protected $fillable = [
        'title',
    ];

    public $timestamps  = false;
}
