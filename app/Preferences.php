<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class preferences extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'client_id', 'text', 'title', 'date'
    ];
        public function clients()
    {
        return $this->belongsTo('Client');
    }
}
