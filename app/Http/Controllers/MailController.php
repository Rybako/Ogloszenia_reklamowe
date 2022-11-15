<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailTest;

class MailController extends Controller
{
     public function index()
  {
    $data = [
      "subject"=>"Mail testowy",
      "body"=>"elo"
      ];
    try
    {
      Mail::to('mlukaszczyk@mailo.com')->send(new MailTest($data));
      return response()->json(['poszlo']);
    }
    catch(Exception $e)
    {
      return response()->json(['cos nie pyklo']);
    }
  }
}
