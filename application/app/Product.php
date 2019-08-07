<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['product_type_id','name','description','price','image'];

    public function product_type(){
    	return $this->belongsTo('App\ProductType');
    }
}
