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
    'lines_customers_display_name',
    'lines_customers_picture_url',
    'lines_customers_reply_available',
    'customers_id',
    'persons_id',
  ];
}
