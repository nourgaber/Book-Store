<?php

namespace App\Services\Interfaces;

interface BookServiceInterface
{

    public function get($Book_id);
    public function all();
    public function destroy($Book_id);
    public function update($Book_id, array $Book_data);
}

?>