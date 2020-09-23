<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Client;

class Agendas extends Controller
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
        $dated = date("Y-m-d H:i");

        $agendas = Agenda::join('clients', 'client_id', '=', 'clients.id')
            ->select('agendas.*','clients.name', 'clients.address', 'clients.phone', 'clients.price')
            ->where('date', ">", $dated)
            ->orderBy('date')
            ->get();
        
        $data = array('agendas'=>$agendas, 'title'=>"Listing Services Scheduled");
        
        return view('agenda.index')->with($data);
    }
  
    public function all($id)
    {        
        $agendas = Agenda::join('id', 'clients', 'client_id', '=', 'clients.id')
            ->select('agendas.*','clients.name', 'clients.address', 'clients.phone', 'clients.price')
            ->where('client_id', $id) 
            ->orderBy('date')
            ->get();

        $data = array('agendas'=>$agendas, 'title'=>"Listing Services From This Client");
        
        return view('agenda.index')->with($data);
    }  
    
    public function week($week)
    {
        $week--;
        $text = "this sunday + ";
        if($week<0){
            $text = "this sunday ";            
        }
        $from = date("Y-m-d", strtotime("$text $week week"));
        if($week+1<0){
            $text = "this saturday ";            
        }
        else{
            $text = "this saturday + ";            
        }
        $to = date("Y-m-d", strtotime("$text ".($week + 1)." week"));
    
        
        $agendas = Agenda::join('id', 'clients', 'client_id', '=', 'clients.id')
            ->select('agendas.*','clients.name', 'clients.address', 'clients.phone', 'clients.price')
            ->whereBetween('date', [$from, $to])
            ->orderBy('date')
            ->get();
        $view_from = date('d/m/Y', strtotime($from));
        $view_to = date('d/m/Y', strtotime($to));
        $data = array('agendas'=>$agendas, 'title'=>"Listing Services Scheduled: $view_from to $view_to");
        return view('agenda.index')->with($data);
    }
    public function day($day)
    {
        $agendas = Agenda::join('id', 'clients', 'client_id', '=', 'clients.id')
            ->select('agendas.*','clients.name', 'clients.address', 'clients.phone', 'clients.price')
            ->whereDate('date', $day) 
            ->orderBy('date')
            ->get();
        $view_day = date('d/m/Y', strtotime($day));
        
        $data = array('agendas'=>$agendas, 'title'=>"Listing Services Scheduled: $view_day");
        
        return view('agenda.index')->with($data);
    }
}
