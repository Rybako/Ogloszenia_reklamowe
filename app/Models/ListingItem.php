<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingItem extends Model
{
    public $timestamps = false;
    protected $table = 'listing_item';
    use HasFactory;
}

