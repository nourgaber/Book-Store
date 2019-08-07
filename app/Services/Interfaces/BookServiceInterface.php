<?php

namespace App\Services\Interfaces;

interface BookServiceInterface
{
    public function show($book_id);
    public function index();
    public function delete($book_id);
    public function update($book_id, array $book_data);
    public function store(array $book_data);
}

?>