<?php


namespace App\Services;
use App\Services\Interfaces\BookServiceInterface;
use App\Repositories\BookRepository;
/**
 * Class BookService
 * @package App\Services
 */
class BookService implements BookServiceInterface
{
    protected $bookrepo;
    /**
     * BookService constructor.
     */
    public function __construct(BookRepository $bookrepo)
    {
        $this->bookrepo = $bookrepo;
    }

    

    public function show($book_id)
{
    return  $this->bookrepo -> show($book_id);
}
    public function index()
    {
        return $this->bookrepo -> index();
    }
    public function delete($book_id)
    {
        $this->bookrepo -> delete($book_id);

    }
    public function update($book_id, array $book_data)
    {
        return  $this->bookrepo -> update($book_id,$book_data);

    }

    public function store(array $book_data)
    {
        return  $this->bookrepo -> store($book_data);
    }
   
}
