<?php

namespace App\Models\Polls;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'polls_answers';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'question_id',
        'title',
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Polls\Question', 'question_id');
    }
}
