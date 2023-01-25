<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ListingItemWithoutBlockedScope;
use App\Scopes\ListingItemWithoutExpiredScope;

class ListingItem extends Model
{
    public $timestamps = false;
    protected $table = 'listing_item';

    public function scopeAllListingItems($query, $pickBlocked=true, $pickExpired=true)
    {
        if($pickBlocked)$query=$query->withoutGlobalScope(ListingItemWithoutBlockedScope::class);
        if($pickExpired)$query=$query->withoutGlobalScope(ListingItemWithoutExpiredScope::class);
        return $query;
    }
    use HasFactory;

        protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ListingItemWithoutBlockedScope);
        static::addGlobalScope(new ListingItemWithoutExpiredScope);
        
    }   
    
}

