<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    
class Client extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'address', 'apartment', 'city', 'latitude', 'longitude', 'latlong', 'phone', 'email', 'price', 'method', 'deleted_at'
    ];
    public function preferences()
    {
        return $this->hasMany('Preference');
    }
    public function agendas()
    {
        return $this->hasMany('Agenda');
    }
}
