<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carinfo extends Model
{
    protected $table = 'carinfo';

    protected $fillable = ['inquiry_id', 'gear', 'transmission', 'engine', 'rudder', 'color', 'run', 'capacity_from', 'capacity_to', 'state', 'owners'];

    public function inquiry()
    {
        return $this->belongsTo('App\Inquiry');
    }

    public function setRunAttribute($value)
    {
        $this->attributes['run'] = preg_replace('/[^0-9]/', '', $value);
    }

}
