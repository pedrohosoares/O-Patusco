<?php
namespace App\Models\Services\Scopes;

use App\Models\Users\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class FilterByUserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
        $rules = Rule::USER_TYPES;
        if($user->rule->name_type == $rules['medico']){
            $builder->whereHas('doctor', function (Builder $query) use ($user) {
                $query->where('users.id', $user->id);
            });
        }
    }
}