<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_customer extends Model
{
  protected $table = 'lines_customers';

  protected $fillable = [
    'lines_customers_id',
    'lines_customers_userid',
    'lines_customers_name',
    'customers_id',
    'persons_id',
  ];
}
