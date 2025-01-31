<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Post;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\TagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });

        static::updating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
