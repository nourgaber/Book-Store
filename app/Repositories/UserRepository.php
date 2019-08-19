<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function store($name, $email, $password, $role)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->activation_token = str_random(60);
        $user->save();
        $user->roles()->attach(Role::where('name', $role)->first());
        // $user->roles()
        //    ->attach(Role::where('name','employee')->first());
        return $user;
    }
    public function show($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        return $user;
    }
    public function showUserByemail($user_email)
    {
        $user= User::where('email', $user_email)->first();
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        return $user;
    }

    public function index()
    {
        return User::all();
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        $user->delete();
    }
    public function update($user_id, array $User_data)
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        $user->update($User_data);
        return $user;
    }
    public function findUserByActivationToken($token)
    {
        $user= User::where('activation_token', $token)->first();
        if (!$user) {
            throw new CustomException('ACTIVATION_TOKEN');
        }
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
