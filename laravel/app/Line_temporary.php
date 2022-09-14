<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_temporary extends Model
{
  protected $table = 'lines_temporaries';

  protected $fillable = [
    'lines_customers_userid',
    'lines_messages_text',
    'users_id',
  ];
}
