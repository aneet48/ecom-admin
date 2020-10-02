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
        'connecty_dialog_id',
        'xmpp_room_jid'
    ];
    protected $appends = ['related_data', 'last_message'];

    public function getRelatedDataAttribute()
    {
        $id = $this->related_id;
        if ($this->related == 'request') {
            return ProductRequest::find($id);
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
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'dialog_id');

    }

}
