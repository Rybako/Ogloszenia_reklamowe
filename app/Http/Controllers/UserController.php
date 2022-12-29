<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ListingItem;
use App\Models\ListingPictures;

class UserController extends Controller
{
    //widok ogłoszeń konkretnego użytkownika
    public function view($id){
        $listing_items = ListingItem::where('user_id', $id)->orderBy('add_date', 'desc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));
        $user = User::select('email','name','phone_number','created_at')->where('id', $id)->first();

        foreach($listing_items as $key=>$item){
            $listing_items[$key]['src']=(ListingPictures::where('listing_item_id','=', $item['id'])->orderBy('order_position', 'asc')->first())['src'];
            }

        return view('user/view',['listing_items' => $listing_items,'user' => $user]);
    }

    public function list(){

        return view('user/list', [ 
            'users' => User::paginate(10)
        ]);
    }

    public function edit(User  $user)
    {
        return view("user/edit_form", [
            'user' => $user,
            
        ]);
        return redirect()->back();
    }

    public function update(Request $request, User  $user)
    {
        
        $user->fill($request->all());
        $user->save();
        return redirect()->back();
        
    }

    public function destroy(User  $user)
    {
        $user->delete();
        return redirect()->back();
    }
 
}
