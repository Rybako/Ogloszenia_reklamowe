<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\ListingItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $user = Auth::user();
    $messages = Message::where('receiver_id', $user->id)->get();
    return view('messages', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $listing_items = ListingItem::all();

        return view('messages.create', compact('listing_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'listing_item_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        $message = new Message([
            'listing_item_id' => $request->get('listing_item_id'),
            'sender_id' => $user->id,
            'receiver_id' => $request->get('receiver_id'),
            'message' => $request->get('message'),
        ]);

        $message->save();

        return redirect('/messages')->with('success', 'Message sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $sender = User::find($message->sender_id);
        $receiver = User::find($message->receiver_id);
        $listing_item = ListingItem::find($message->listing_item_id);

        return view('messages.show', compact('message', 'sender', 'receiver', 'listing_item'));
    }
}
