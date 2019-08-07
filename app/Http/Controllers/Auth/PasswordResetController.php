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

       if(!$result)
       response()->json([
        'message' => 'We cannot find a user with that e-mail address'], 404);
        else
        response()->json([
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
        $result= $this->passwordservice -> find($token);
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$result)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
    
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
       $result= $this->passwordservice -> reset($request->token,$request->email,$request->password);

        
        if ($result==1)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if ($result==2)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
       
        return response()->json($user);
    }
}
