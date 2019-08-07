<?php
namespace App\Repositories;
use App\PasswordReset;


class PasswordResetRepository 
{
    public function getPasswordReset ($user)
    {
      return  PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
             ]
        );
    }
    public function FindByToken($token)
    {
return PasswordReset::where('token', $token)
->first();
    }

    public function findbyTokenEmail($token,$email)
    {
       return PasswordReset::where([
            ['token', $token],
            ['email', $email]
        ])->first();
    }


}