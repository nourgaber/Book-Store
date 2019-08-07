<?php
namespace App\Repositories;
use App\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
class BookRepository implements BookRepositoryInterface
{
  

    public function show($book_id)
    {

    return Book::find($book_id);
    }

    public function index()
    {
        return Book::all();
    }
    public function delete($book_id)
    {
        Book::destroy($book_id);
        echo 'book deleted';

    }
    public function update($book_id, array $book_data)
    {
        $book= Book::find($book_id);
        $book->update($book_data);
        return $book;
      

    }
    public function store(array $book_data)
    {
        return $Book = Book::create($book_data);
    }
  

}