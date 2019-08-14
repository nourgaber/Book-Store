<?php


namespace App\Services;
use Illuminate\Http\Request;
use App\Role;
use App\Services\Interfaces\AuthServiceInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail; 
use App\Mail\UserAuthEmail;
use Illuminate\Support\Facades\Mail;
use App\Events\UserEvent;
use App\Jobs\SendEmailJob;
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
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user=$this->Userrepo-> activateUser($user);
        $user->notify(new WelcomeEmail($user));
        return $user;
    }
    
    public function login( Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = $this->Userrepo->store($request->name,$request->email,$request->password,$request->role);
        event(new UserEvent($user));

     $url = url('api/auth/signup/activate/'.$user->activation_token);
     $when = now()->addMinutes(10);

     dispatch(new SendEmailJob($user,$url));
  
     dd('done');
      //  Mail::to(  $request->email)->queue(new UserAuthEmail($request->name,$url));
        //->later($when, new UserAuthEmail($request->name,$url));
       // $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}



