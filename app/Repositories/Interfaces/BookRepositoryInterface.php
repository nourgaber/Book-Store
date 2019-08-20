<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{

    public function show($book_id);
    public function index();
    public function delete($book_id);
    public function update($book_id,$book_name,$book_renting_price,$book_price,$author_id);
    public function store($book_name,$book_renting_price,$book_price,$author_id);
}

?>