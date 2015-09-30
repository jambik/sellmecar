<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $fillable = ['user_id', 'car_id', 'carinfo_id', 'model', 'price_from', 'price_to', 'year_from', 'year_to', 'city_id', 'metro', 'street', 'name', 'phone', 'information'];

    protected $appends = ['price_from_formatted', 'price_to_formatted'];

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeByUser($query, $id)
    {
        return $query->where('user_id', $id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carinfo()
    {
        return $this->hasOne('App\Carinfo');
    }

    /**
     * @return int|string
     */
    public function getPriceFromFormattedAttribute()
    {
        return $this->price_from ? number_format(floatval($this->price_from), 0, '.', ' ') : 0;
    }

    /**
     * @return int|string
     */
    public function getPriceToFormattedAttribute()
    {
        return $this->price_to ? number_format(floatval($this->price_to), 0, '.', ' ') : 0;
    }

}
