<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
class BookController extends Controller
{
    protected $book;

    public function __construct(BookService $bookservice)
    {
        $this->book = $bookservice;
    }

    public  function show(Request $request){
        //echo "show called";
        return  $books =$this->book ->show($request->id);
        //$books = DB::select('select * from Books where id = ?', [1]);
        //dd($books);
    }

    public function index(Request $request)
    {
        return   $books =$this->book ->index();
    }

    public function store(Request $request)
    {
        return  $this->book->store( $request->all());
    }

    public function update(Request $request)
    {
        return $books =$this->book->update($request->id,$request->all());

    }


    public function delete(Request $request)
    {
         $books =$this->book ->delete($request->id);

    }
}
