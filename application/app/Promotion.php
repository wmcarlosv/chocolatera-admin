<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $fillable = ['name','description','price'];

    public function products(){
    	return $this->belongsToMany('App\Product','promotion_products','promotion_id','product_id');
    }
}
