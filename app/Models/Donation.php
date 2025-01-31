<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * 
 *
 * @property int $id
 * @property int|null $amount
 * @property string $currency
 * @property string $payment_method
 * @property int $payment_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $donator
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Donation extends Model
{
    
    public function donator()
    {
        return $this->belongsTo(User::class);
    }
}
