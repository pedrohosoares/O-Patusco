<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    use HasFactory;

    public const USER_TYPES = [
        'medico'=>'medico',
        'recepcionista'=>'recepcionista',
        'cliente'=>'cliente'
    ];

    public const USER_TYPES_ID = [
        'medico'=>3,
        'recepcionista'=>2,
        'cliente'=>1
    ];

    protected $fillable = [
        'name_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
