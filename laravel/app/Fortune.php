<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fortune extends Model
{
  protected $table = 'fortunes';
    //
  protected $fillable = [
      'id', 
      'fortunes_worry', 
      'fortunes_answer',
  ];
}
