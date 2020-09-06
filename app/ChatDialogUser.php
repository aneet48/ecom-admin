<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatDialogUser extends Model
{
     protected $fillable = [
        'dialog_id',
        'user_id',
    ];
}
