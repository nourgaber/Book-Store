<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{

    public function show($User_id);
    public function index();
    public function destroy($User_id);
    public function update($User_id, array $User_data);

}

?>