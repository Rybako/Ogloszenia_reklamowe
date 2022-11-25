<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingPictures extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_position'];
    protected $table = 'listing_pictures';
    use HasFactory;
}
