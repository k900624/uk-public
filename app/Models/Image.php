<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'object_name',
        'object_id',
        'file_name',
        'title',
        'mime_type',
        'size',
        'ordering',
        'main',
    ];
    
    public $timestamps = false;
}
