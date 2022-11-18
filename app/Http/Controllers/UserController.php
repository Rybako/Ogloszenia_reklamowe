<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ListingItem;
use App\Models\ListingPictures;

class UserController extends Controller
{
    //formularz rejestracji
    public function create() {
        return view('users.register');
    }

    //tworzenie usera 
    public function store(Request $request) { //wstępna walidacja
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')], //unikalny email w tabeli users
            'password' => 'required|confirmed' //w formularzu pole password musi być zgodne z polem password_confirmed
        ]);

        //hash
        $formFields['password'] = bcrypt($formFields['password']);

        //tworzenie usera
        $user = User::create($formFields);

        //automatyczny login po rejestracji
        auth()->login($user);

        return redirect('/')->with('message', 'User stworzony i zalogowany');
    }

    //formularz logowania
    public function login() {
        return view('users.login');
    }

    //logowanie
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {

            $request->session()->regenerate();

            return redirect('/')->with('message', 'Zalogowano poprawnie');
        }

        return back()->withErrors(['email' => 'Niepoprawne dane'])->onlyInput('email');

    }

    //wylogowanie
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('welcome');
    }

    //widok
    public function view($id){
        $listing_items = ListingItem::where('user_id', $id)->orderBy('add_date', 'desc')->paginate(8);
        $user = User::where('id', $id)->first();

        foreach($listing_items as $key=>$item){
            $listing_items[$key]['src']=(ListingPictures::where('listing_item_id','=', $item['id'])->orderBy('order_position', 'asc')->first())['src'];
            }

        return view('user/view',['listing_items' => $listing_items,'user' => $user]);
    }
 
}
