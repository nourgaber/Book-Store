<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Http\Request;
use App\Jobs\SendEmail;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
class EmailService 
{
    protected $user;
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
 
    
/**
 * Store a newly created resource in storage.
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
 */
public function store(Request $request)
{
    $baseDelay = json_encode(now());

    $getDelay = json_encode(
        cache('jobs.' . SendEmail::class, $baseDelay)
    );

    $setDelay = Carbon::parse(
        $getDelay->date
    )->addSeconds(10);

    cache([
        'jobs.' . SendEmail::class => json_encode($setDelay)
    ], 5);
    SendEmail::dispatch($user, new VerifyEmail($user))
         ->delay($setDelayTime);
}
   
}
