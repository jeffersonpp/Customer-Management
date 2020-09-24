<?php

namespace App\Http\Controllers\Preference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Preference;

class UpdatePreference extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
         $pref = Preference::find($id);
         $client_id = $pref->client_id;
         $pref->delete();
    
         return redirect("/client/{$client_id}")->with('success', 'Preference deleted Successfully');
    }
}
