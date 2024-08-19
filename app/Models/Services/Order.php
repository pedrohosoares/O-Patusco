<?php

namespace App\Models\Services;

use App\Models\Animals\Animal;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'animal_id',
        'symptoms'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
    
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class,'animal_id','id');
    }
}
