<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ListingItem extends Model
{
    public $timestamps = false;
    protected $table = 'listing_item';
    use HasFactory;

        protected static function boot()
    {
        parent::boot();

        static::retrieved(function($model){
            $model->pickBlocked ? null: ( $model->blocked ? $model->break : null) ;
        });
    }   
}

