<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use App\User;
use Illuminate\Mail\Mailable;

class SendEmail implements ShouldQueue
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
public function __construct(User $user, Mailable $mail)
{
    $this->user = $user;
    $this->mail = $mail;
}
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }

}
