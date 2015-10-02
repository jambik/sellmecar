<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carinfo extends Model
{
    protected $table = 'carinfo';

    protected $fillable = ['inquiry_id', 'gear', 'transmission', 'engine', 'rudder', 'color', 'capacity_from', 'capacity_to', 'state', 'owners'];

    public function inquiry()
    {
        return $this->belongsTo('App\Inquiry');
    }


}
