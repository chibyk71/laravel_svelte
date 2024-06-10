<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "content",
        "user_id",
        "post_id"
    ];

    public function commenter() {
        return $this->belongsTo(User::class,"user_id");
    }

    public function post() {
        return $this->belongsTo(Post::class,"post_id");
    }

    public function likes() {
        return $this->belongsToMany(User::class,"comment_like")->withTimestamps();
    }

    public function isLiked() : bool {
        return $this->likes()->where("user_id","=",auth()->user()->id)->exists();
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

}
