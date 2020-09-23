<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'client_id', 'date', 'cancel'
    ];
    public function clients()
    {
        return $this->belongsTo('Client');
    }
}
