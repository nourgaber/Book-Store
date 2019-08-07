<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    public function get($User_id);

    public function all();
    public function destroy($User_id);
    public function update($User_id, array $User_data);
}

?>