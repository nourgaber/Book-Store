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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = $this->Userrepo->activateUser($user);
        $user->notify(new WelcomeEmail($user));
        return $user;
    }

    public function login($email, $password)
    {
        $credentials = [$email, $password];
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if (!Auth::attempt($credentials)) {
            throw new CustomException('Unauthorized_User');
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }
    public function signup(SignupRequest $request)
    {
        $user = $this->Userrepo->store($request->name, $request->email, $request->password, $request->role);
        event(new UserEvent($user));
        $url = url('api/auth/signup/activate/' . $user->activation_token);
        dispatch(new SendEmailJob($user, $url));

        //  Mail::to(  $request->email)->queue(new UserAuthEmail($request->name,$url));
        //->later($when, new UserAuthEmail($request->name,$url));
        // $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
