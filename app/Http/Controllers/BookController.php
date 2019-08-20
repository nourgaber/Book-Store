<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
class BookController extends Controller
{
    protected $book;

    public function __construct(BookService $bookservice)
    {
        $this->book = $bookservice;
    }

    public  function read(Request $request){
        //echo "show called";
        return  $books =$this->book ->show($request->id);
        //$books = DB::select('select * from Books where id = ?', [1]);
        //dd($books);
    }

    public function getAll(Request $request)
    {
        return   $books =$this->book ->index();
    }

    public function create(BookRequest $request)
    {
        return  $this->book->store($request->book_name,$request->book_renting_price,$request->book_price,$request->author_id);
    }

    public function update(Request $request)
    {
        return $books =$this->book->update($request->id,$request->book_name,$request->book_renting_price,$request->book_price,$request->author_id);

    }


    public function delete(Request $request)
    {
         $books =$this->book ->delete($request->id);

    }
}
