<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Exception;
use DatePeriod;
use DateInterval;
use App\Models\ListingItem;
use App\Models\User;
use App\Models\ListingPictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListingItemController extends Controller
{
    //

    function index(){ // Domyślny widok ogłoszeń wyswietla określoną liczbę ostatnio dodanych
        $listing_items = ListingItem::orderBy('add_date', 'desc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));
        foreach($listing_items as $key=>$item){
            $listing_items[$key]['src']=(ListingPictures::where('listing_item_id','=', $item['id'])->orderBy('order_position', 'asc')->first())['src'];
            }

        return view('listing_item/search',['listing_items' => $listing_items]);

    }
    function search(Request $search_data){
        $price_minimum = $search_data->has('price_min') ? $search_data->get('price_min') : 0;
        $price_maximum = $search_data->has('price_max') ? $search_data->get('price_max') : 999999;
        $height_minimum = $search_data->has('height_min') ? $search_data->get('height_min') : 0;
        $width_minimum = $search_data->has('width_min') ? $search_data->get('width_min') : 0;
        $category = $search_data->has('category') ? $search_data->get('category') : 0;
        $sort = $search_data->has('sort') ? $search_data->get('sort') : 'new';
        //$category ='Wszystkie Kategorie';

        $listing_items = ListingItem::where( [['price', '>=', (int)$price_minimum], ['price', '<=', (int)$price_maximum],
        ['height', '>=', (int)$height_minimum], ['width', '>=', (int)$width_minimum]]
                                            );
        if($category!='Wszystkie Kategorie') $listing_items= $listing_items->where('category','=', $category);


        //TO je console log list jakbym chciał sobie zobaczyć jak wygląda zapytanie w sql
        error_log($listing_items->toSql());
        error_log((string)$listing_items->getBindings()[0]);
        error_log((string)$listing_items->getBindings()[1]);
        error_log((string)$listing_items->getBindings()[2]);
        error_log((string)$listing_items->getBindings()[3]);
        if($sort == 'new') $listing_items= $listing_items ->orderBy('add_date', 'desc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));
        if($sort == 'cheap') $listing_items= $listing_items ->orderBy('price', 'asc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));
        if($sort == 'expensive') $listing_items= $listing_items ->orderBy('price', 'desc')->paginate(env('PAGINATION_NUMBER_OF_PAGES'));

        foreach($listing_items as $key=>$item){
            $listing_items[$key]['src']=(ListingPictures::where('listing_item_id','=', $item['id'])->orderBy('order_position', 'asc')->first())['src'];
            }



        return view('listing_item/search',['listing_items' => $listing_items]);
    }
    function create(){

        return view('listing_item/create');
    }
    function create_form(Request $create_data){
        $title = $create_data->has('title') ? $create_data->get('title') : null;
        $price = $create_data->has('price') ? $create_data->get('price') : null;
        $height = $create_data->has('height') ? $create_data->get('height') : null;
        $width = $create_data->has('width') ? $create_data->get('width') : null;
        $address = $create_data->has('address') ? $create_data->get('address') : null;
        $position_X = $create_data->has('position_X') ? $create_data->get('position_X') : null;
        $position_Y = $create_data->has('position_Y') ? $create_data->get('position_Y') : null;
        $category = $create_data->has('category') ? $create_data->get('category') : null;
        $content = $create_data->has('content') ? $create_data->get('content') : null;
        $validator = Validator::make($create_data->all(), [
            'title'=>'required',
            'price'=>'required|numeric',
            'height'=>'required|numeric',
            'width'=>'required|numeric',
            'address'=>'required',
            'images' => 'required',
            'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'position_X'=>'required',
            'position_Y'=>'required',
            'category'=>'required',
            'content' => 'required'

        ]);

        if ($validator->fails()) {

            error_log(json_encode($create_data->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $images=[];
        $date = new DateTime();
        $add_date =  $date->format('Y-m-d H:i:s');
        $date->add(new DateInterval('P30D'));
        $expiration_date = $date->format('Y-m-d H:i:s');
        error_log(json_encode($images));
        foreach($create_data->images as $key => $image){
            $imageName = time().'_'.$key.'.'.$image->extension();
            $images[$key]=$imageName;
        }
        try{
            DB::beginTransaction();
        $id = ListingItem::insertGetId(
            [
            'title' => $title,
            'price' => $price,
            'height' => $height,
            'width' => $width,
            'address' => $address,
            'add_date' => $add_date,
            'expiration_date' =>  $expiration_date,
            'user_id' => Auth::id(),// in this place will be email taken from user.email field if logged in or from email given by user if not logged, remember to check if it doesnt exist as registered
            'position_X' => floatval($position_X), // position x for map addon
            'position_Y' => floatval($position_Y), // position y for map addon,
            'content' => $content,
            'category' => $category
            ]
        );
        foreach($images as $key => $imageName){
        ListingPictures::insertGetId(
            [
            'listing_item_id' => $id,
            'order_position' => $key,
            'src' => $imageName
            ]
        );
        if($id!= null){
            $create_data->images[$key]->move(public_path('images'), $images[$key]);
        }
        }
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
            var_dump($e); die(); //jakby sie wyjebalo to bd wiadomo co

        }

        if( empty($id) ){
            redirect()->back()->with('error', 'Coś nie działa!');
         }
        else {
            return redirect()->back()->with('success', 'Poprawnie utworzono ogłoszenie o id '.$id)->with('id',$id);
        }
    }
    function view($id){
        $item = ListingItem::where('id', $id)->first();
        $images = ListingPictures::where('listing_item_id','=',$id)->orderBy('order_position', 'asc')->get();
        $user = User::select('id','name','email','phone_number')->where('id',$item['user_id'])->first();
        
        return view('listing_item/view',['item' => $item,'images' => $images, 'user' => $user]);
    }
    function edit($id){
        $item = ListingItem::where('id', $id)->first();
        $images = ListingPictures::where('listing_item_id','=',$id)->orderBy('order_position', 'asc')->get();
        $user = User::where('id',$item['user_id'])->first();
        return view('listing_item/edit',['item' => $item,'images' => $images, 'user' => $user]);
    }
    function edit_form(Request $create_data,$id){
        $title = $create_data->has('title') ? $create_data->get('title') : null;
        $price = $create_data->has('price') ? $create_data->get('price') : null;
        $height = $create_data->has('height') ? $create_data->get('height') : null;
        $width = $create_data->has('width') ? $create_data->get('width') : null;
        $address = $create_data->has('address') ? $create_data->get('address') : null;
        $category = $create_data->has('category') ? $create_data->get('category') : null;
        $content = $create_data->has('content') ? $create_data->get('content') : null;

        $validator = Validator::make($create_data->all(), [
            'title'=>'required',
            'price'=>'required|numeric',
            'height'=>'required|numeric',
            'width'=>'required|numeric',
            'address'=>'required',
            'category'=>'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if(ListingItem::find($id)['user_id']==Auth::id()){
            
        ListingItem::where('id',$id)->update(
            [
            'title' => $title,
            'price' => $price,
            'height' => $height,
            'width' => $width,
            'address' => $address,
            'category' => $category,
            'content' => $content
            ]
        );

        $images=[];
        if($create_data->images!=null)
        foreach($create_data->images as $key => $image){
            $imageName = time().'_'.$key.'.'.$image->extension();
            $images[$key]=$imageName;

        }
        try{
            DB::beginTransaction();
            $position=ListingPictures::where('listing_item_id',$id)->max('order_position');
            foreach($images as $key => $imageName){
                ListingPictures::insertGetId(
                    [
                    'listing_item_id' => $id,
                    'order_position' => (int)$position+(int)$key+1,
                    'src' => $imageName
                    ]
                );
            if($id!= null){
                $create_data->images[$key]->move(public_path('images'), $images[$key]);
            }
            }

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            var_dump($e); die(); //jakby sie wyjebalo to bd wiadomo co

        }   
    }
    return redirect()->back();
    }
    function delete($id){
    return   redirect()->back();
    }
    function add_time($id){
        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        $expiration_date = $date->format('Y-m-d H:i:s');


        if(ListingItem::find($id)['user_id']==Auth::id()){
            
           $item= ListingItem::where('id',$id);
           $item->update(['expiration_date' => $expiration_date]);
           if($item->wasChanged())
           redirect()->back()>with('success', 'Poprawnie przedłużono ogłoszenie o id '.$id);
        else{
            redirect()->back()>with('error', 'Nie udało się przedłużyć ogłoszenia o id'.$id);
        }
            

        
        }
        else{
            redirect()->back()>with('error', 'Niezgodność id użytkownika i edytowanego ogłsozenia');
        }
                 

    }

}
