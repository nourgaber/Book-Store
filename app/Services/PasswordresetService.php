<?php


namespace App\Services;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;

use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail; 

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
/**
 * Class UserService
 * @package App\Services
 */
class PasswordresetService 
{
    protected $Userrepo;
    protected $PasswordResetRepo;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $Userrepo ,PasswordResetRepository $PasswordResetRepo)
    {
        $this->Userrepo = $Userrepo;
        $this->PasswordResetRepo=$PasswordResetRepo;
    }

    public function create( $email)
    {
        $user =  $this->Userrepo->showUserByemail($email);
        if (!$user)
            return false;
        $passwordReset = $this->PasswordResetRepo->getPasswordReset($user);
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return true;
    }
    public function find($token)
    {
        $passwordReset = $this->PasswordResetRepo-> FindByToken($token);
        if (!$passwordReset)
            return false;
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return false;
        }
        return response()->json($passwordReset);
    }

    public function reset($token,$email,$password)
    {
        
        $passwordReset =  $this->PasswordResetRepo->findbyTokenEmail($token,$email);
        if (!$passwordReset)
        dd(  $passwordReset);
            return 1;
        $user = $this->Userrepo->showUserByemail($passwordReset->email);
        if (!$user)
            return 2;
        $user->password = bcrypt($password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return 3;
    }
}
