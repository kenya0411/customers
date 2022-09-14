<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_message extends Model
{
  protected $table = 'lines_messages';

  protected $fillable = [
    'lines_messages_id',
    'lines_customers_userid',
    'lines_messages_replytoken',
    'lines_messages_text',
    'lines_messages_from_userid',
    'lines_messages_to_userid',
    'lines_messages_webhook_event_id',
    'updated_at',
    'created_at',
  ];
}
