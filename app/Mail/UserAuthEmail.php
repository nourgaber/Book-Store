<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAuthEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email')->with(['username'=>$this->user,'url'=>$this->url]);//->attach($path);;
    }
}
