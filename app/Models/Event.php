<?php

namespace App\Models;
use App\Models\Center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $objective
 * @property string $event_date
 * @property string $location
 * @property string $timing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Center|null $center
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereTiming($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
