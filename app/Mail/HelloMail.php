<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $idea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $idea)
    {
        $this->user = $user;
        $this->idea = $idea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->user);
        return $this
        ->subject("You have comment")
        ->view('mail.comments')
        ->with(['user'=> $this->user,
                'content'=> $this->user,
                'idea'=>$this->idea,
                ]);
    }
}
