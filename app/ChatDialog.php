<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatDialog extends Model
{
    protected $fillable = [
        'chat_type',
        'related',
        'related_id',
        'user_id',
    ];
    protected $appends = ['related_data', 'last_message'];

    public function getRelatedDataAttribute()
    {
        $id = $this->related_id;
        if ($id == 'event') {
            return Event::with('images')->find($id);
        } else {
            return Product::with('images')->find($id);
        }
    }

    public function users()
    {
        return $this->hasMany(ChatDialogUser::class, 'dialog_id');
    }

    public function getLastMessageAttribute()
    {
        return ChatMessage::where(['dialog_id' => $this->id])->first();

    }
    public function unreadMessages()
    {
        return $this->hasMany(ChatMessage::class, 'dialog_id')->where('read', false);

    }

}
