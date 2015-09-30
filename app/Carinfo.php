<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carinfo extends Model
{
    protected $table = 'carinfo';

    protected $fillable = ['car_id', 'gear', 'transmission', 'engine', 'rudder', 'color', 'capacity_from', 'capacity_to', 'state', 'owners'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car()
    {
        return $this->belongsTo('App\Car');
    }

}
