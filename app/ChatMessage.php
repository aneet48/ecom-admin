<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'dialog_id',
        'user_id',
        'message',
        'message_type',
        'file',
    ];

    protected $with = ['sender', 'reciever'];

    public function scopeBySender($q, $sender)
    {
        $q->where('sender_id', $sender);
    }

    public function scopeByReciever($q, $sender)
    {
        $q->where('reciever_id', $sender);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }
    

}
