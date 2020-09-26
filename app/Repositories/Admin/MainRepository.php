<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;
use \DB;
use \Str;
use Carbon\Carbon;

class MainRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public static function getCountAreas()
    {
        $result = DB::table('areas')
            ->get()
            ->count();

        return $result;
    }

    public static function getCountArticles()
    {
        $result = DB::table('content')
            ->where('cat_id', '>', 0)
            ->get()
            ->count();

        return $result;
    }

    public static function getCountUsers()
    {
        $result = DB::table('users')
            ->get()
            ->count();

        return $result;
    }

    public static function getCountCategories()
    {
        $result = DB::table('categories')
            ->get()
            ->count();

        return $result;
    }

    public static function getCountNewMessages()
    {
        $result = DB::table('feedback')
            ->where('is_view', '0')
            ->get()
            ->count();

        return $result;
    }

    public static function getNewMessages()
    {
        $messages = DB::table('feedback')
            ->where('is_view', '0')
            ->get();
            
        foreach ($messages as $message) {
            $message->message = Str::words(strip_tags(html_decode($message->message)), 8);
            $message->timeago = Carbon::parse($message->created_at)->diffForHumans();
        }

        return $messages;
    }

    public static function getCountNewComments()
    {
        $result = DB::table('comments')
            ->where('is_view', '0')
            ->get()
            ->count();

        return $result;
    }

    public static function getNewComments()
    {
        $comments = DB::table('comments')
            ->where('is_view', '0')
            ->get();
            
        foreach ($comments as $comment) {
            $comment->message = Str::words(strip_tags(html_decode($comment->message)), 8);
            $comment->timeago = Carbon::parse($comment->created_at)->diffForHumans();
            
            if ( ! empty($comment->username)) {
                $comment->name = $comment->username;
            } else {
                $comment->name = ($comment->name) ? $comment->name : 'deleted';
            }
        }

        return $comments;
    }
    
    public static function getCountFeeds()
    {
        $result = DB::table('activities')
            ->get()
            ->count();

        return $result;
    }
    
    public static function getFeeds()
    {
        $result = DB::table('activities')
            ->select(
                'activities.id',
                'activities.activity',
                'activities.created_at',
                'activities.type',
                'activities.user_id',
                'users.name'
            )
            ->orderBy('activities.created_at', 'desc')
            ->limit(10)
            ->join('users', 'activities.user_id', '=', 'users.id', 'left')
            ->get();
            
        return $result;
    }

}