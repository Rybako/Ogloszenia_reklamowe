<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\listing_item;

class listing_item_controller extends Controller
{
    //
    
    function index(){
        $listing_items = listing_item::all();
        $name='a';
        return view('search',['listing_items' => $listing_items,'name' => $name]);
        
    }
}
