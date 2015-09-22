<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['title', 'text', 'image', 'published_at'];

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $appends = ['img_url', 'img_size'];

    /*public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::parse();
    }*/

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
        $imgThumb['icon']  = '?w=120&h=120&fit=crop&'.$this->updated_at->timestamp;
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
            $file = $request->file('image')->move(static::imagePath(), Str::slug($request->get('news'), '_').".".Str::lower($request->file('image')->getClientOriginalExtension()));
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
        return config('laravel-glide.source.path').'/news';
    }

    /**
     * Get Image url path
     *
     * @return string
     */
    public static function imageUrl()
    {
        return '/img/news/';
    }

}
