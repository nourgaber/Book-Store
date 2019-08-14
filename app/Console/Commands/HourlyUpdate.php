<?php

namespace App\Console\Commands;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;
use App\Notifications\WelcomeEmail; 
use App\Mail\UserAuthEmail;
use Illuminate\Support\Facades\Mail;
class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an hourly email to all the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $Userrepo;
    public function __construct(UserRepository $Userrepo)
    {
        parent::__construct();
        $this->Userrepo = $Userrepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
   public function handle()
   {
       $user = $this->Userrepo -> index();
       foreach ($user as $a)
       {
   Mail::raw("This is automatically generated Hourly Update", function($message) use ($a)
   {
       $message->to($a->email)->subject('Hourly Update');
   });
   }
   $this->info('Hourly Update has been send successfully');
   }
}
