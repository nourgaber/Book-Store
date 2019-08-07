<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserAuthEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cannot find a user with that e-mail address'], 404);
    
        if ($user)
        Mail::to( $user->user())->queue(new UserAuthEmail($user));
          
        return response()->json([
            'message' => 'We have e-mailed you!'
        ]);
 
    }


}
