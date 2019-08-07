<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busines extends Model
{
    protected $table = 'business';

    protected $fillable = ['name','email','phone','commission'];
}
