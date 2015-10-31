<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImagableTrait
{
    /**
     * Get Image url path attribute
     *
     * @return string
     */
    public function getImgUrlAttribute()
    {
        return $this->imageUrl();
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
            $imageName      = strtolower(class_basename($this)).'-'.$item->id;
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());

            $file = $request->file('image')->move($this->imagePath(), $imageName.".".$imageExtension);
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
    public function imagePath()
    {
        return storage_path('images').DIRECTORY_SEPARATOR.$this->getTable();
    }

    /**
     * Get Image url path
     *
     * @return string
     */
    public function imageUrl()
    {
        return $this->getTable().'/';
    }
}
