<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Project;

/**
 * 
 *
 * @property int $id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Project> $projects
 * @property-read int|null $projects_count
 * @method static \Database\Factories\ImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'image_post');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'image_project');
    }
}
