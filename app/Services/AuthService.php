<?php
namespace App\Services;

use App\Events\UserEvent;
use App\Jobs\SendEmailJob;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail;
use App\Repositories\UserRepository;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\ResponseService;
use Carbon\Carbon;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use App\Constants\SuccessConstants;
/**
 * Class UserService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{

    /**
     * UserService constructor.
     */
    protected $Userrepo;
    public function __construct(UserRepository $Userrepo)
    {
        $this->Userrepo = $Userrepo;
    }
    public function signupActivate($token)
    {
        $user = $this->Userrepo->findUserByActivationToken($token);
        if (!$user) {
            throw new CustomException('ACTIVATION_TOKEN');
        }
        $user = $this->Userrepo->activateUser($user);
        $user->notify(new WelcomeEmail($user));
        return $user;
    }

    public function login($email,$password,$remember_me)
    {
        $credentials ['email']  = $email;
        $credentials['password'] = $password;
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
       if (!Auth::attempt($credentials)) {          
            $user = $this->Userrepo-> showUserByemail($email);
            if(!$user)
            throw new CustomException('Email_NOT_FOUND');
            else
            throw new CustomException('WRONG_PASSWORD');
        }

        $user = $this->Userrepo-> showUserByemail($email);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        $message=SuccessConstants::Success_MESSAGES['OK'];
        $httpcode=SuccessConstants::Success_CODES['OK'];
        return ResponseService::generateResponseWithSuccessData($message,$httpcode,[
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }
    public function signup($name,$email,$password,$role)
    {
        $user = $this->Userrepo->store($name,$email,$password,$role);
        event(new UserEvent($user));
        $url = url('api/auth/signup/activate/' . $user->activation_token);
        dispatch(new SendEmailJob($user, $url));
        $message=SuccessConstants::Success_MESSAGES['UserCreated'];
        $httpcode=SuccessConstants::Success_CODES['UserCreated'];
        return ResponseService::generateResponseWithSuccess($message,$httpcode);
    }

    public function logout($user)
    {
        $user->token()->revoke();
        $message=SuccessConstants::Success_MESSAGES['UserLoggedout'];
        $httpcode=SuccessConstants::Success_CODES['UserLoggedout'];
        return ResponseService::generateResponseWithSuccess($message,$httpcode);
    }
}
