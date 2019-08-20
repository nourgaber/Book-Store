<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserEvent;
use App\PasswordReset;
use App\Services\PasswordresetService;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use App\Services\AuthService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
class UserController extends Controller
{
    use Queueable, SerializesModels;

    protected $user;
    protected $passwordservice;
    protected $AuthService;

    public function __construct(UserService $userservice,PasswordresetService $passwordservice,AuthService $AuthService)
    {
        $this->user = $userservice;
        $this->passwordservice = $passwordservice;
        $this->AuthService = $AuthService;

    }


    public function create(Request $request)
    {
        
     //   $request->user()->authorizeRoles(['employee', 'manager']);
        $newUser=$this->user->store($request->name, $request->email, $request->password,$request->role);
        event(new UserEvent($newUser));
        return $newUser;
    }
    
    public function getAll()
    {
       return $users = $this->user->index();
    }

    public function read(Request $request)
    {
        try {
            $user =  $this->user->show($request->id);
        } catch (UserNotFoundException $exception) {
            report($exception);
            return back()->withError($exception->getMessage())->withInput();
        }
        return $this->user->show($request->id);

    }
    public function update(Request $request)
    {
         return $this->user->update($request->id, $request->name, $request->email);    }

    public function destroy(Request $request)
    {
        $this->user->destroy($request->id);
    }

    public function createPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
       $result= $this->passwordservice -> create( $request->email);

       return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    public function find($token)
    {
        $passwordReset= $this->passwordservice -> find($token);      
        return response()->json($passwordReset);
    }
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
       $user= $this->passwordservice -> reset($request->token,$request->email,$request->password);

       
        return response()->json($user);
    }

    public function signup(SignupRequest $request)
    {
        return $this->AuthService->signup($request->name, $request->email, $request->password, $request->role);
    }
    public function signupActivate($token)
    {
        return $this->AuthService->signupActivate($token);
    }

    public function login(LoginRequest $request)
    {
        return $this->AuthService->login($request->email, $request->password, $request->remember_me);
    }

    public function logout(Request $request)
    {
        return $this->AuthService->logout($request->user());

    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
