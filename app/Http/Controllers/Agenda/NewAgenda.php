<?php

namespace App\Http\Controllers\Agenda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Agenda;

class NewAgenda extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function create()
    {
       $client = Client::select('id', 'name', 'phone', 'address')
		->orderBy('name', 'ASC')
		->get();
       return view('agenda.create')->with('clients',$client);
    }

    public function insert(Request $request)
    {
      $request->validate([
        'client_id'=>'required',
        'date'=> 'required'
      ]);
      $agenda = new Agenda([
        'client_id' => $request->get('client_id'),
        'date'=> $request->get('date'),
        'cancel'=> "0"
      ]);
      $agenda->save();
      return redirect('/agendas')->with('success', 'Service has been added');
    }
}
