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
      'orders_is_reserve_finished',
      'orders_is_ship_finished',
      'users_id',
      'updated_at',
      'created_at',
      'orders_notice'
  ];
}
