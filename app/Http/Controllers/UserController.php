<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserEvent;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserService $userservice)
    {
        $this->user = $userservice;
       // $this->middleware('auth');
    }


    public function store(Request $request)
    {
        
     //   $request->user()->authorizeRoles(['employee', 'manager']);
        $newUser=$this->user->store($request->name, $request->email, $request->password,$request->role);
        event(new UserEvent($newUser));
        return $newUser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $users = $this->user->index();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      //  $request->user()->authorizeRoles(['employee']);
        return $this->user->show($request->id);

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
        $request->user()->authorizeRoles(['manager']);
          $this->user->update($request->id, $request->all());
          return $this->user->show($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'manager']);
        $this->user->destroy($request->id);
    }


  
}
