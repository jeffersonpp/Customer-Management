<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Agenda;
use App\Preferences;

class Clients extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::select('id', 'name', 'phone', 'address', 'method')
		->orderBy('name', 'ASC')
		->get();

        return view('client.index', compact('clients'));
    }
    /**
     * Show the client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $client = Client::find($id);
        $agendas = Agenda::where('client_id',$id)->get();
        $preferences = Preferences::where('client_id',$id)->get();

        $data = array('client'=>$client,'agendas'=>$agendas,'preferences'=>$preferences);
        return view('client.show')->with($data);
    }
}