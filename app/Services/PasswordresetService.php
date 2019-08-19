<?php


namespace App\Services;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;

use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
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
        return response()->json([
            'message' => 'We cannot find a user with that e-mail address'], 404);
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
        return response()->json([
            'message' => 'This password reset token is invalid.'
        ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return $passwordReset;
    }

    public function reset($token,$email,$password)
    {
        
        $passwordReset =  $this->PasswordResetRepo->findbyTokenEmail($token,$email);
        if (!$passwordReset)     
       return response()->json([
            'message' => 'This password reset token is invalid.' ], 404);
        $user = $this->Userrepo->showUserByemail($passwordReset->email);
        if (!$user)
        return response()->json([
            'message' => 'We cant find a user with that e-mail address.'
        ], 404);
        $user->password = bcrypt($password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return $user;
    }
}
