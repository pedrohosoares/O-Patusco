<?php

namespace App\Models\Animals;

use App\Models\Services\Order;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'observations',
        'owner_id',
        'race_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
