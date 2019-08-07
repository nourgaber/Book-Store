<?php
namespace App\Repositories;
use App\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
class BookRepository implements BookRepositoryInterface
{
    public function get($post_id)
    {

    return Book::find($BookISPN);
    }

    public function all()
    {
        return Book::all();
    }
    public function delete($post_id)
    {
        Book::destroy($post_id);

    }
    public function update($post_id, array $post_data)
    {
        Book::find($post_id)->update($post_data);
      

    }
}