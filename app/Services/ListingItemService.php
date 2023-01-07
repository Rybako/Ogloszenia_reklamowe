<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;
use Illuminate\Support\Facades\File;
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
       ListingItem::find($id)->delete();


    }
}