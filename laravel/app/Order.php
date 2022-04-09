<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';

  protected $fillable = [
      'orders_id', 
      'customers_id', 
      'products_id',
      'products_options_id',
      'persons_id',
      'orders_price',
      'orders_notice'
  ];
}
