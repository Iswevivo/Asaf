<?php

namespace App\Models;
use App\Models\Type;
use App\Models\Resource;
use App\Models\Partener;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $objective
 * @property string $start_date
 * @property string $end_date
 * @property float|null $budget
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partner> $partners
 * @property-read int|null $partners_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Resource> $resources
 * @property-read int|null $resources_count
 * @property-read Type|null $type
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project withoutTrashed()
 * @mixin \Eloquent
 */
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, softDeletes;

    protected $casts = [
        'status' => 'string',
    ];

    public function getStatusAttribute($value)
    {
        return match ($value) {
            'holding' => 'En attente',
            'processing' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé',
            default => 'Inconnu',
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });

        static::updating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }

    
    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }
}
