<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;
use Illuminate\Support\Facades\File;
use App\Services\ImageService;
class ImageController extends Controller
{
    //
   /* function move_left(){

    }
    function move_rigth(){

    }*/ 
    function set_main($id){
        $image = ListingPictures::find($id);
        $listing_item= ListingItem::find($image['listing_item_id']);
        if(  $listing_item['user_id']==Auth::id()){
            /////////////////////////////////////////////////////
            
            $images = ListingPictures::where('listing_item_id','=',$image['listing_item_id'])->orderBy('order_position', 'asc')->get();
                if($images->count()>1){
                    /////////////////////////////
                    
                    try{
                        DB::beginTransaction();
                        $images->where('order_position',0)->first()->update(['order_position' => $image['order_position']]);
                        $image->update(['order_position' => 0]);

                        DB::commit();
                        return redirect()->back();
                    }
                    catch(Exception $e){
                        DB::rollback();
                    }
                    /////////////////////////////
                }
                else{
                    return redirect()->back();
                }
            }
    }
    
    function delete($id, ImageService $imageService){
        $image= ListingPictures::find($id);
        $listing_item= ListingItem::find($image->listing_item_id);
        
        if(  $listing_item['user_id']==Auth::id()){
        return $imageService->deleteImage($id);
        }
    }
}
