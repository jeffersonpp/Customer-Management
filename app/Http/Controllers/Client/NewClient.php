<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class NewClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
public function create()
{
   return view('client.create');
}

    public function insert(Request $request)
    {
      $request->validate([
        'name'=>'required',
        'address'=> 'required'
      ]);
      $client = new Client([
        'name' => $request->get('name'),
        'address'=> $request->get('address'),
        'city'=> $request->get('city'),
        'apartment'=> $request->get('apartment'),
        'latitude'=> $request->get('address_latitude'),
        'longitude'=> $request->get('address_longitude'),
        'phone'=> $request->get('phone'),
        'email'=> $request->get('email'),
        'price'=> $request->get('price'),
        'method'=> $request->get('method')
      ]);
      $client->save();
      return redirect('/clients')->with('success', 'Client has been added');
    }
}
