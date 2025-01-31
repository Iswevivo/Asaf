<?php

namespace App\Models;
use App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string|null $website_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner withoutTrashed()
 * @mixin \Eloquent
 */
class Partner extends Model
{
    use softDeletes;

    protected $fillable = ['website_url']; // Ajoutez d'autres champs que vous souhaitez rendre remplissables

    public static $rules = [
        'website_url' => 'nullable|url', // Validation pour s'assurer que c'est une URL valide
    ];

    
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
