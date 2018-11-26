<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'post_id', 'comment'];

    public function posts()
    {
        return $this->belongsToMany('App/Post');
    }

    public static function bringComments($post_id)
    {
        $comment = Comment::where('post_id', $post_id)
                    ->count();
        return $comment;
    }

    public static function existComment($post_id)
    {
        $exist = Comment::where('post_id', $post_id)
                ->join('users', 'comments.user_id', 'users.id')
                ->get();

        return $exist;
    }
}
