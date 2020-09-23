<?php

namespace App\Http\Controllers\Preference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Preferences;

class UpdatePreference extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
         $pref = Preferences::find($id);
         $client_id = $pref->client_id;
         $pref->delete();
    
         return redirect("/client/{$client_id}")->with('success', 'Preference deleted Successfully');
    }
}
