<?php
namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{

    public function show($book_id)
    {

        $book = Book::find($book_id);
        if (!$book) {
            throw new CustomException('Book_NOT_FOUND');
        }
        return $book;
    }

    public function index()
    {
        return Book::all();
    }
    public function delete($book_id)
    {
        $book = Book::find($book_id);
        if(!$book)
        throw new CustomException('Book_NOT_FOUND');
        $book->delete();
    }
    public function update($book_id, array $book_data)
    {
        $book = Book::find($book_id);
        if(!$book)
        throw new CustomException('Book_NOT_FOUND');
        $book->update($book_data);
        return $book;

    }
    public function store(array $book_data)
    {
        return $Book = Book::create($book_data);
    }

}
