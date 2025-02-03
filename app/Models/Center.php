<?php

namespace App\Models;
use App\Models\Program;
use App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Program> $programs
 * @property-read int|null $programs_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Center withoutTrashed()
 * @mixin \Eloquent
 */
class Center extends Model
{
    use softDeletes;

    protected $fillable = ['name', 'description', 'address', 'phone', 'email', 'is_active'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
