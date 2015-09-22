<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metro extends Model
{
    protected $table = 'metro';

    protected $fillable = ['name', 'city_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }


}
