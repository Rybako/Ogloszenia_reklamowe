<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;

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
                        return redirect()->back()->with('success', 'Udało się zmienić obrazek.');
                    }
                    catch(Exception $e){
                        DB::rollback();
                    }
                    /////////////////////////////
                }
                else{
                    return redirect()->back()->with('error', 'Masz tylko 1 obrazek.');
                }
            }
    }
    
    function delete($id){
        $image = ListingPictures::find($id);
        $listing_item= ListingItem::find($image['listing_item_id']);
        if(  $listing_item['user_id']==Auth::id()){
            /////////////////////////////////////////////////////
            if($image['order_position']!=0){
            ListingPictures::destroy($image['id']);
            }
            else{
                $images = ListingPictures::where('listing_item_id','=',$image['listing_item_id'])->orderBy('order_position', 'asc')->get();
                if($images->count()>1){
                    /////////////////////////////
                    
                    try{
                        DB::beginTransaction();
                        $images->skip(1)->first()->update(['order_position' => 0]);
                        ListingPictures::destroy($image['id']);
                        DB::commit();

                    }
                    catch(Exception $e){
                        DB::rollback();
                    }
                    /////////////////////////////
                }
                else{
                    return redirect()->back()->with('error', 'Nie można skasować ostatniego obrazka.');
                }
                return redirect()->back();
            }

            /////////////////////////////////////////////////////
            redirect()->back()->with('success', 'Skasowano');
        }
        else redirect()->back()->with('error', 'Brak zgodności id!');
    }
}
