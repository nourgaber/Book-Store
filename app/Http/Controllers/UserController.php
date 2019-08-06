<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
 
class UserController extends Controller
{

    protected $user;

    public function __construct(UserService $userservice)
    {
        $this->user = $userservice;
    }

    public  function FindUserByid(){
        echo "index called";
        $users =$this->user ->all();
        //$books = DB::select('select * from Books where id = ?', [1]);
        dd($users);
    }

    public function store(Request $request)
{
    $this->user ->store($request->name,$request->email,$request->password);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
{
    $this->user ->show( $request->id);
   
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $this->user->update($request->id,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->user ->destroy( $request->id);
    }

    public function login(Request $request)
    {
        $this->user ->login( $request->email,$request->password);
    }
}
