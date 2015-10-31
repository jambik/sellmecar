<?php

namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use ImagableTrait;

    protected $table = 'cars';

    protected $fillable = ['domestic', 'name', 'image'];

    protected $appends = ['img_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquiries()
    {
        return $this->hasMany('App\Inquiry');
    }

    /**
     * @return mixed
     */
    public function inquiriesCount()
    {
        return $this->hasOne('App\Inquiry')->selectRaw('car_id, count(*) as aggregate')->groupBy('car_id');
    }

    /**
     * @return int
     */
    public function getInquiriesCountAttribute()
    {
        if ( ! $this->relationLoaded('inquiriesCount')) $this->load('inquiriesCount'); // if relation is not loaded already, let's do it first
        $related = $this->getRelation('inquiriesCount');

        return ($related) ? (int)$related->aggregate : 0; // then return the count directly
    }
}
