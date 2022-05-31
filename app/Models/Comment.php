<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

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

        // static::addGlobalScope(new LatestScope);
    }
}
