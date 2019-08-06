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

    public function show($id)
{
    $this->bookrepo -> show($id);
}
    public function get($post_id)
    {
       
    }
    public function all()
    {
        $this->bookrepo -> all();
    }
    public function destroy($post_id)
    {

    }
    public function update($post_id, array $post_data)
    {
        
    }
}
