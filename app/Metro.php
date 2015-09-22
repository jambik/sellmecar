<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metro extends Model
{
    protected $table = 'metro';

    protected $fillable = ['name', 'city'];


}
