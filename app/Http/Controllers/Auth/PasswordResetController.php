<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use App\Services\PasswordresetService;


class PasswordResetController extends Controller
{
    protected $passwordservice;
    /**
     * UserService constructor.
     */
    public function __construct(PasswordresetService $passwordservice)
    {
        $this->passwordservice = $passwordservice;
    }
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
       $result= $this->passwordservice -> create( $request->email);

       return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset= $this->passwordservice -> find($token);
        
       
            
    
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
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
}
