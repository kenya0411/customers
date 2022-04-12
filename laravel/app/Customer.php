<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'customers';
    //
  protected $fillable = [
      'customers_nickname', 
      'customers_name',
      'customers_address',
      'customers_note',
      'updated_at',
      'created_at',
      // 'customers_age',
      'persons_id'
  ];
}
