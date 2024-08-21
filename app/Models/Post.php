<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 25);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            Storage::delete($post->image);
        });

        static::updating(function ($post) {
            if ($post->isDirty('image') && ($post->getOriginal('image') !== null)) {
                Storage::delete($post->getOriginal('image'));
            }
        });
    }
}
