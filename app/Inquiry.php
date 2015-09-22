<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $fillable = ['user_id', 'car_id', 'model', 'transmission', 'price_from', 'price_to', 'year_from', 'year_to', 'city', 'metro', 'street', 'name', 'phone', 'information'];

    protected $appends = ['price_from_formatted', 'price_to_formatted', 'transmission_name'];

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

    /**
     * @return string
     */
    public function getTransmissionNameAttribute()
    {
        $transmissions = ['0' => 'Не важно', '1' => 'Автомат', '2' => 'Механическая'];
        return $transmissions[$this->transmission];
    }
}
