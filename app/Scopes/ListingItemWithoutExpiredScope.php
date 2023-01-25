<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 
class ListingItemWithoutExpiredScope implements Scope
{

 
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        error_log('Y-m-d H:i:s');
        $builder->where('expiration_date','>',date('Y-m-d H:i:s'));
    }
}