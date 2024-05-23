<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'caption'
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, "post_id");
    }

    public function isLiked(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        $liker = Auth::user();
        return $this->likes()->wherePivot("user_id", "=", $liker->id)->exists();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, "likes")->withTimestamps();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }
}
