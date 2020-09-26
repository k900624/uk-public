<?php

namespace App\Models\Polls;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'started_at',
        'ended_at',
        'created_at',
        'updated_at',
        'published',
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Polls\Question', 'poll_id');
    }

    public function answersQuestion()
    {
        return $this->questions()->answers;
    }
}
