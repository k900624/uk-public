<?php

namespace App\Http\Controllers\Api;

use App\Models\Polls\Poll;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Resources\PollResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PollController extends ApiController
{
    public function index(Request $request)
    {
        $polls = Poll::where('published', '1')
            ->latest()
            ->get();

        $user = User::findOrFail(Auth::user()->id);
        $today = Carbon::now()->toDateString();

        foreach ($polls as $key => $poll) {

            $isVoted = \DB::table('poll_user')->where([
                'poll_id' => $poll->id,
                'user_id' => $user->id,
            ])->exists();

            $isNotStarted = ($today < $poll->started_at) ? true : false;

            $isEnded = ($today > $poll->ended_at) ? true : false;

            if ($isVoted) {
                $poll->error = [
                    'error'   => true,
                    'message' => 'Вы уже участвовали в этом голосовании!',
                ];
            } elseif ($isNotStarted) {
                $poll->error = [
                    'error'   => true,
                    'message' => 'Голосование еще не началось!',
                ];
            } elseif ($isEnded) {
                $poll->error = [
                    'error'   => true,
                    'message' => 'Голосование уже закончилось!',
                ];
            } else {
                $poll->error = [
                    'error'   => false,
                    'message' => '',
                ];
            }
        }

        return PollResource::collection($polls);
        // return new PollResource($poll);
    }

    public function show(Request $request)
    {
        $poll = Poll::where('published', '1')
            ->latest()
            ->firstOrFail();

        $user = User::findOrFail(Auth::user()->id);

        $isVoted = \DB::table('poll_user')->where([
            'poll_id' => $poll->id,
            'user_id' => $user->id,
        ])->exists();

        $today = Carbon::now()->toDateString();

        $isNotStarted = ($today < $poll->started_at) ? true : false;

        $isEnded = ($today > $poll->ended_at) ? true : false;

        if ($isVoted) {
            $poll->error = [
                'error'   => true,
                'message' => 'Вы уже участвовали в этом голосовании!',
            ];
        } elseif ($isNotStarted) {
            $poll->error = [
                'error'   => true,
                'message' => 'Голосование еще не началось!',
            ];
        } elseif ($isEnded) {
            $poll->error = [
                'error'   => true,
                'message' => 'Голосование уже закончилось!',
            ];
        } else {
            $poll->error = [
                'error'   => false,
                'message' => '',
            ];
        }

        return new PollResource($poll);
    }

    public function store(Request $request)
    {
        $rules = [
            'poll_id' => 'required|integer',
            'answers' => 'required',
            'comment' => 'string|nullable',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        $poll_id = $request->poll_id;
        $user_id = $user->id;
        $comment = $request->comment;
        $answers = json_encode($request->answers);

        // Проверка возможности голосования
        $poll = Poll::find($poll_id);

        $error = null;

        $isVoted = \DB::table('poll_user')->where([
            'poll_id' => $poll_id,
            'user_id' => $user_id,
        ])->exists();

        $today = Carbon::now()->toDateString();

        $isNotStarted = ($today < $poll->started_at) ? true : false;

        $isEnded = ($today > $poll->ended_at) ? true : false;

        if ($isVoted) {
            $error = [
                'status' => 'error',
                'message' => 'Вы уже участвовали в этом голосовании!',
            ];
        } elseif ($isNotStarted) {
            $error = [
                'status' => 'error',
                'message' => 'Голосование еще не началось!',
            ];
        } elseif ($isEnded) {
            $error = [
                'status' => 'error',
                'message' => 'Голосование уже закончилось!',
            ];
        }

        if ( ! $error) {
            \DB::table('poll_user')->insertOrIgnore([
                'user_id'    => $user_id,
                'poll_id'    => $poll_id,
                'answers'    => $answers,
                'comment'    => $comment,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            $result = ['status' => 'success'];

        } else {
            $result = $error;
        }

        return response()->json($result);
    }

}
