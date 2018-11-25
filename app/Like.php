<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id'];

    public function posts()
    {
        return $this->belongsToMany('App/Post');
    }

    public static function bringLike($post_id)
    {
        $like = Like::where('post_id', $post_id)
                ->count();

                return $like;
    }

    public static function existLike($user_id, $post_id)
    {
        $like = Like::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->count();
        return $like;
    }
}
