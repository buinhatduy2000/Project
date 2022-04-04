<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitIdea extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $category_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $category_mail)
    {
        $this->user = $user;
        $this->category_mail = $category_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Someone submit new Idea")
        ->view('mail.ideas')
        ->with(['user'=> $this->user,
                'category_mail'=> $this->category_mail,
                ]);
    }
}
