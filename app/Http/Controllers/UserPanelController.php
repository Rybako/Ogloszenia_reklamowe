<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;
use Illuminate\Support\Facades\File;

class UserPanelController extends Controller
{
    public function listing_items(){
        $id = Auth::id();
        $listing_items = ListingItem::where('user_id', $id)->orderBy('add_date', 'desc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));
        $user = User::select('email','name','phone_number','created_at')->where('id', $id)->first();

        foreach($listing_items as $key=>$item){
            $listing_items[$key]['src']=(ListingPictures::where('listing_item_id','=', $item['id'])->orderBy('order_position', 'asc')->first())['src'];
            }

        return view('userpanel/listing_items',['listing_items' => $listing_items,'user' => $user]);
    }


}