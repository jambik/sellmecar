<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $table = 'cars';

    protected $fillable = ['name', 'image'];

    protected $appends = ['img_url', 'img_size'];

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

    /**
     * Get Image url path attribute
     *
     * @return string
     */
    public function getImgUrlAttribute()
    {
        return static::imageUrl();
    }

    /**
     * Get Image sizes attribute (as array of glide url paths)
     *
     * @return array
     */
    public function getImgSizeAttribute()
    {
        $imgThumb['xs']    = '?w=50&h=50&fit=crop&'.$this->updated_at->timestamp;
        $imgThumb['icon']  = '?w=100&h=100&fit=crop&'.$this->updated_at->timestamp;
        $imgThumb['thumb'] = '?w=280&h=280&fit=crop&'.$this->updated_at->timestamp;
        return $imgThumb;
    }

    /**
     * Save Item Image
     *
     * @param         $item
     * @param Request $request
     *
     * @return bool
     */
    public function saveImage($item, Request $request)
    {
        if ($request->hasFile('image'))
        {
            $file = $request->file('image')->move(static::imagePath(), Str::slug($request->get('name'), '_').".".Str::lower($request->file('image')->getClientOriginalExtension()));
            $item->image = $file->getFilename();
            $item->save();
        }

        return true;
    }

    /**
     * Get Image directory path
     *
     * @return string
     */
    public static function imagePath()
    {
        return config('laravel-glide.source.path').'/cars';
    }

    /**
     * Get Image url path
     *
     * @return string
     */
    public static function imageUrl()
    {
        return '/img/cars/';
    }
}
