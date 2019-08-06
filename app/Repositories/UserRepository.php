<?php
namespace App\Repositories;
use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
class UserRepository implements UserRepositoryInterface
{
    public function store($name,$email,$password)
{
   $user = new User;
   $user->name =$name;
   $user->email = $email;
   $user->password = $password;
   $user->save();
}
    public function get($user_id)
    {
       return  User::find($user_id);
    }

    public function all()
    {
        return User::all();
    }
    public function show($id)
    {
         // Retrieve a model by its primary key...
    $user = User::find($id);
    echo $user . '<br>';
  //  $count = App\Post::where('category', 'laravel')->count();
   // $max = App\Post::where('category', 'laravel')->max('views');
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
    public function login($email,$password)
    {
        $user=User::where("email",$email)->get();
        echo $user;
        if($user == null)
        echo 'wrong email';
        else if($user->password == $password)
        echo 'welcome '.$user->name;
        else
        echo 'wrong password';

    }
    
}