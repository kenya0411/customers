<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_person extends Model
{
  protected $table = 'lines_persons';

  protected $fillable = [
    'persons_id',
    'lines_persons_userid',
    'lines_persons_channel_id',
    'lines_persons_channel_secret',
    'lines_persons_access_token',
  ];
}
