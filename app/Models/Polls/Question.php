<?php

namespace App\Models\Polls;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'polls_questions';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'poll_id',
        'description',
    ];

    public function poll()
    {
        return $this->belongsTo('App\Models\Polls\Poll', 'poll_id');
    }

    public function answers()
    {
        // TODO does not work
        return $this->hasMany('App\Models\Polls\Answer', 'question_id');
    }
}
