<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ship extends Model
{
  protected $table = 'ships';
  protected $fillable = [
      'id', 
      'orders_is_ship_finished', 
  ];
}
