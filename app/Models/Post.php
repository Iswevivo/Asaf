<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
Use App\Models\Tag;
use App\Models\Image;
use App\Models\Comment;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $status
 * @property int $user_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User|null $author
 * @property-read Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'content', 'status', 'category_id',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    public static function statuses()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_PUBLISHED,
            self::STATUS_ARCHIVED,
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}