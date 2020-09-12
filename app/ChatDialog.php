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
    protected $appends = ['related_data','last_message'];


    public function getRelatedDataAttribute()
    {
        $id = $this->related_id;
        if ($id == 'event') {
            return Event::find($id);
        } else {
            return Product::find($id);
        }
    }

    public function users()
    {
        return $this->hasMany(ChatDialogUser::class, 'dialog_id');
    }

     public function getLastMessageAttribute()
    {
        return ChatMessage::where(['dialog_id'=>$this->id])->first();

    }

}
