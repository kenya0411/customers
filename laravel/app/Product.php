<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';
    //
  protected $fillable = [
      'products_id', 
      'products_name', 
      'products_price', 
      'products_method', 
      'products_detail', 
      'persons_id', 
  ];
}
