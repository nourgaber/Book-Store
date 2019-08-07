<?php


namespace App\Services\Interfaces;
use Illuminate\Http\Request;

use App\Services\Interfaces\AuthServiceInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail; 

interface AuthServiceInterface 
{
    public function signupActivate($token);
    public function login( Request $request);
    public function signup(Request $request);
    public function logout(Request $request);
}



