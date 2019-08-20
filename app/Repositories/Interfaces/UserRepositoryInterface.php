<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    public function show($User_id);

    public function index();
    public function destroy($User_id);
    public function update($User_id,$name,$password);
    //public function login($email,$password);
   // public function singup();
 //   public function logout();
}

?>