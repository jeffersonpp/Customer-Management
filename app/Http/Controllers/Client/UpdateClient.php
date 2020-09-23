<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class UpdateClient extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
{
        $client = Client::find($id);

        return view('client.edit', compact('client'));
}

public function Update(Request $request, $id)
{
      $request->validate([
        'name'=>'required',
        'address'=> 'required'
      ]);
        
      $client = Client::find($id);
      $client ->name = $request->get('name');
      $client ->address = $request->get('address');
      $client ->city = $request->get('city');
      $client ->apartment = $request->get('apartment');
      $client ->latitude = $request->get('latitude');
      $client ->longitude = $request->get('longitude');
      $client ->latlong = $request->get('latlong');
      $client ->phone = $request->get('phone');
      $client ->email = $request->get('email');
      $client ->price = $request->get('price');
      $client ->method = $request->get('method');
      
      $client->save();
      return redirect('/clients')->with('success', 'Client has been saved');
}
    
public function destroy($id)
{
     $client = Client::find($id);
     $client->delete();

     return redirect('/clients')->with('success', 'Client has been deleted Successfully');
}
}

?>