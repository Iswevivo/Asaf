<?php

namespace App\Models;
use App\Models\Center;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $days
 * @property string $timing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Center|null $center
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTiming($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program withoutTrashed()
 * @mixin \Eloquent
 */
class Program extends Model
{
    use softDeletes;

    protected $fillable = ['title', 'slug', 'description', 'days', 'timing', 'center_id'];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
