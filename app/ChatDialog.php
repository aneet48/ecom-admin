<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatDialog extends Model
{
    protected $fillable = [
        'chat_type',
        'related',
        'related_id',
    ];

   
}
