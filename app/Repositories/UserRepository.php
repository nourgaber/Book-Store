<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function store($name, $email, $password, $role)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->activation_token = str_random(60);
        $user->save();
        $user->roles()->attach(Role::where('name', $role)->first());
        return $user;
    }
    public function show($user_id)
    {
        return User::find($user_id);

    }
    public function showUserByemail($user_email)
    {
       return User::where('email', $user_email)->first();   
    }
    public function checkUserPassword($user_email,$password)
    {
       $user =User::where('email', $user_email)->first();
       if($user->password==Hash::make($password))
       return true;
       else
       return false;   
    }

    public function index()
    {
        return User::all();
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if(!$user)
        return false;
        $user->delete();
        return true;
    }
    public function update($user_id, $name, $email)
    {
        $user = User::find($user_id);
        if(!$user)
        return false;
        if($name != null)
        $user->name = $name;
        if($email != null)
        $user->email = $email;
        $user->save();
        return $user;
    }
    public function findUserByActivationToken($token)
    {
        $user = User::where('activation_token', $token)->first();
        return $user;
    }
    public function activateUser($user)
    {
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
    
}
