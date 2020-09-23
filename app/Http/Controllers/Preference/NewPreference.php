<?php

namespace App\Http\Controllers\Preference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Preferences;

class NewPreference extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
public function create($id)
{
   return view('preference.create')->with('id', $id);
}

    public function insert(Request $request)
    {
      $request->validate([
        'client_id'=>'required',
        'text'=> 'required'
      ]);
      $pref = new Preferences([
        'client_id' => $request->get('client_id'),
        'title'=> $request->get('title'),
        'text'=> $request->get('text'),
        'date'=> date('Y-m-d')
      ]);
      $pref->save();
      return redirect('/client/'.$request->get('client_id') )->with('success', 'Preference has been added');
    }
}
