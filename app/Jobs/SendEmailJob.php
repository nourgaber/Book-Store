<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use App\User;
use Illuminate\Mail\Mailable;
use App\Mail\UserAuthEmail;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   /**
 * @var User
 */
protected $user;

/**
 * @var Mailable
 */
protected $mail;

/**
 * Create a new job instance.
 *
 * @param User $user
 * @param Mailable $mail
 */
protected $url;
public function __construct(User $user,$url)
{
    $this->user = $user;
    $this->url = $url;
  //  $this->mail = $mail;
}
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to( $this->user->email)->send(new UserAuthEmail( $this->user->name, $this->url));

    }

}
