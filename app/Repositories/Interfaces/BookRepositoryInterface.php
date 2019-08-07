<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{

    public function get($post_id);

    public function all();
    public function delete($post_id);
    public function update($post_id, array $post_data);
}

?>