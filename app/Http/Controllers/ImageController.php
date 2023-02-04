<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\ListingItem;
use App\Models\ListingPictures;
use App\Services\ImageService;

class ImageController extends Controller
{
    // Ustawia obrazek jako główny w ogłoszeniu
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
                        return redirect()->back();
                    }
                    /////////////////////////////
                }
                else{
                    return redirect()->back();
                }
            }
    }
    
    // Usuwa obrazek
    function delete($id, ImageService $imageService){
        $image= ListingPictures::find($id);
        $listing_item= ListingItem::find($image->listing_item_id);
        
        if(  $listing_item['user_id']==Auth::id()){
            $imageService->deleteImage($id);
        return redirect()->back();
        }
    }
}
