<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    protected $table = 'carmodels';

    protected $fillable = ['name', 'car_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car()
    {
        return $this->belongsTo('App\Car');
    }

}
