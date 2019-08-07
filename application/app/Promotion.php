<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $fillable = ['name','description','price'];
}
