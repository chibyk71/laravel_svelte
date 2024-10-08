<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "content",
        "user_id",
        "comment_id"
    ];

    public function replier() {
        return $this->belongsTo(User::class,"user_id");
    }

    public function comment() {
        return $this->belongsTo(Comment::class,"comment_id");
    }

    public function likes() {
        return $this->belongsToMany(User::class,"reply_like")->withTimestamps();
    }

    public function isLiked() : bool {
        return $this->likes()->where("user_id","=",auth()->user()->id)->exists();
    }
}
