<?php

namespace App\Http\Controllers;
use App\models\Payment;
use Session;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function save(Request $request)
    {
        $data = new Payment;
        $data->card_number= $request->gift_number;
        $data->customer_number= $request->customer_number;
        $data->balance= $request->balance;
        $data->save();
        return redirect()->route('home')->with('success',"Your payment made successfully !!");
        //Session::flash('success', "Your payment made successfully !!",array('timeout' => 3000));
        //return redirect()->route('home');
    }
}
