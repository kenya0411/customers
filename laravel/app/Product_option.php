<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_option extends Model
{
  protected $table = 'products_options';
     protected $fillable = [
      'products_options_id', 
      'products_options_name', 
      'products_options_price', 
      'products_options_detail', 
      'persons_id', 
      'products_id', 
  ]; 
}
