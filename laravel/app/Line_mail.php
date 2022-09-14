<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_mail extends Model
{
  protected $table = 'lines_mails';

  protected $fillable = [
    'lines_mails_id',
    'lines_mails_mailaddress',
    'users_id',
  ];
}
