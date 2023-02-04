<?php
namespace App\Services;
use App\Models\ListingItem;
use App\Models\ListingPictures;

class ListingItemService
{
    public function deleteListingItem($id)
    {
        $imageService = new ImageService;


      $pictures = ListingPictures::where('listing_item_id',$id)->get();
       foreach($pictures as $picture){
            error_log($picture['id']);
            $imageService->deleteImage($picture['id'], true);
       }
       ListingItem::allListingItems()->find($id)->delete();


    }
}