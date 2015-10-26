<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'blocks';

    protected $fillable = ['alias', 'title', 'text'];

}
