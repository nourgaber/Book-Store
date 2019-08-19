<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail;
use App\Services\AuthService;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Mail\UserAuthEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    use Queueable, SerializesModels;
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */

    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }


    public function signup(Request $request)
    {
        return $this->AuthService ->signup($request);
    }
    public function signupActivate($token)
    {
        return $this->AuthService ->signupActivate($token);
    }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */


    public function login(LoginRequest $request)
    {
        return $this->AuthService ->login($request->email,$request->password);
    }
 /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        return $this->AuthService ->logout( $request);
      
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}