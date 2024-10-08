<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool {
        return boolval($this->is_admin);
    }

    public function isPostLiked(Post $post): bool {
        return $this->likes()->where("post_id",$post->id)->exists();
    }

    public function likes() {
        return $this->belongsToMany(Post::class, "likes")->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function commentLikes() {
        return $this->belongsToMany(Comment::class,"comment_like")->withTimestamps();
    }

    public function replyLikes() {
        return $this->belongsToMany(Reply::class,"reply_like")->withTimestamps();
    }
}
