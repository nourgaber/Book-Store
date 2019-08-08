<?php
namespace App\Repositories;
use App\User;
use App\Role;
use App\Repositories\Interfaces\UserRepositoryInterface;
class UserRepository implements UserRepositoryInterface
{
    public function store($name,$email,$password,$role)
{
   $user = new User;
   $user->name =$name;
   $user->email = $email;
   $user->password = $password;
   $user-> activation_token =str_random(60);
   $user->save();
   $user->roles()->attach(Role::where('name',$role)->first());
  // $user->roles()
   //    ->attach(Role::where('name','employee')->first());
 return $user;
}
    public function show($user_id)
    {
       return  User::find($user_id);
    }
    public function showUserByemail($user_email)
    {
       return User::where('email', $user_email)->first();
    }

    public function index()
    {
        //echo "hiii";
        return User::all();
    }
    
    public function destroy($user_id)
    {
        User::destroy($user_id);
        echo 'done deleting '.$user_id;

    }
    public function update($user_id, array $User_data)
    {
        User::find($user_id)->update($User_data);
    }
    public function findUserByActivationToken($token)
    {
 return User::where('activation_token', $token)->first();
    }
}