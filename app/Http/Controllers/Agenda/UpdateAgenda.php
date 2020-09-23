<?php

namespace App\Http\Controllers\Agenda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Agenda;

class UpdateAgenda extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
{
        $agenda = Agenda::find($id);
        $clients = Client::select('id', 'name', 'phone', 'address')
                    ->orderBy('name', 'ASC')
                    ->get();
        $data = array('agenda'=>$agenda, 'clients'=>$clients);
        return view('agenda.edit')->with($data);
}

public function Update(Request $request, $id)
{
      $request->validate([
        'date'=>'required',
        'client_id'=> 'required'
      ]);
        
      $agenda = Agenda::find($id);
      $agenda ->date = $request->get('date');
      $agenda ->client_id = $request->get('client_id');
      $agenda ->cancel = "0";
     
      
      $agenda->save();
      return redirect('/agendas')->with('success', 'Service has been Updated');
}
    
public function destroy($id)
{
     $agenda = Agenda::find($id);
     $agenda->delete();

     return redirect('/agendas')->with('success', 'Service deleted Successfully');
}
}

?>