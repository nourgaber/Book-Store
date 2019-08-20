<?php
namespace App\Repositories;

use App\Models\Book;
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
        $book = Book::find($book_id);
        if (!$book) {
            return false;
        }
        $book->delete();
        return true;
    }
    public function update($book_id,$book_name,$book_renting_price,$book_price,$author_id)
    {
        $book = Book::find($book_id);
        if(!$book)
        return false;
        if($book_name!=null)
        $book->book_name = $book_name;
        if($book_renting_price!=null)
        $book->book_renting_price = $book_renting_price;
        if($book_price!=null)
        $book->book_price = $book_price;
        if($author_id!=null)
        $book->author_id = $author_id;
        $book->save();
        return $book;

    }
    public function store($book_name,$book_renting_price,$book_price,$author_id)
    {
        $book = new Book;
        $book->book_name = $book_name;
        $book->book_renting_price = $book_renting_price;
        $book->book_price = $book_price;
        $book->author_id = $author_id;
        $book->save();
        return $book;
    }

}
