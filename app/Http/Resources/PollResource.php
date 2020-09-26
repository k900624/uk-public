<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Polls\Answer;

class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        foreach ($this->questions as $question) {
            $answers[$question->id] = Answer::where('question_id', $question->id)->orderBy('ordering')->get();
        }

        return [
            'type'       => 'polls',
            'id'         => $this->id,
            'attributes' => [
                'title'       => $this->title,
                'description' => $this->description,
                'started_at'  => $this->started_at,
                'ended_at'    => $this->ended_at,
                'questions'   => $this->questions,
                'answers'     => $answers,
                'status'      => $this->error,
            ],
        ];
    }
}
