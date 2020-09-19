<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatDialogUser extends Model
{
    protected $fillable = [
        'dialog_id',
        'user_id',
    ];

    protected $with = [ 'user'];

    public function dialog()
    {
        return $this->belongsTo(ChatDialog::class, 'dialog_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

  

   
}
