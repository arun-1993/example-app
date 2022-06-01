<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'content', 'blog_post_id'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeNewest(Builder $builder)
    {
        return $builder->orderBy(static::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->id}");
            Cache::tags(['blog-post'])->forget('most-commented');
        });

        // static::addGlobalScope(new LatestScope);
    }
}
