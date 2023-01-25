<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;
use Illuminate\Support\Facades\File;

class ImageService
{
    public function deleteImage($id, $ignoreLast = False)
    {
        $image = ListingPictures::find($id);
        $listing_item= ListingItem::allListingItems()->find($image['listing_item_id']);
        if(  $listing_item['user_id']==Auth::id()){
            /////////////////////////////////////////////////////
            if($image['order_position']!=0){
            ListingPictures::destroy($image['id']);
            File::delete(public_path('images').'/'.$image['src']);
            }
            else{
                $images = ListingPictures::where('listing_item_id','=',$image['listing_item_id'])->orderBy('order_position', 'asc')->get();
                if($images->count()>1 or $ignoreLast==True ){
                    /////////////////////////////
                    
                    try{
                        DB::beginTransaction();
                        if(!$ignoreLast)$images->skip(1)->first()->update(['order_position' => 0]);
                        $imageName=$image['src'];
                        ListingPictures::destroy($image['id']);
                        DB::commit();
                        File::delete(public_path('images').'/'.$imageName);

                    }
                    catch(Exception $e){    
                        DB::rollback();
                        return redirect()->back()->with('error', 'Coś się nie udało');
                    }
                    /////////////////////////////
                }
                else{
                    return redirect()->back()->with('error', 'Nie można skasować ostatniego obrazka.');
                }
                
            }
            return redirect()->back()->with('success', 'Skasowano');

            /////////////////////////////////////////////////////
            
        }
        else redirect()->back()->with('error', 'Brak zgodności id!');


    }
}