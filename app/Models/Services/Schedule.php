<?php

namespace App\Models\Services;

use App\Models\Services\Scopes\FilterByUserScope;
use App\Models\Users\User;
use App\Models\Users\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'order_id',
        'completed'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new FilterByUserScope);
    }

    public function doctor(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'schedule_doctor');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
