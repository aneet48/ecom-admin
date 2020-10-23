<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostDeleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title, $type)
    {
        $this->user = $user;
        $this->title = $title;
        $this->type = $type;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->type == 'product' ? 'Product' : 'Product Request' . ' deleted ')->markdown('mails.post_deleted')->with([
            'user' => $this->user,
            'title' => $this->title,
            'type' => $this->type,
        ]);

        // return $this->markdown('mails.post_deleted');
    }
}
