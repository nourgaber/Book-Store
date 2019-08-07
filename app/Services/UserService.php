<?php


namespace App\Services;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeEmail; 
/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $Userrepo;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $Userrepo)
    {
        $this->Userrepo = $Userrepo;
    }

    public function store($name,$email,$password)
    {
        $this->Userrepo ->store($name,$email,$password);
    }
    public function show($id)
    {
        return  $this->Userrepo -> show($id);
    }
   
    public function index()
    {
      return  $this->Userrepo -> index();
    }
    public function destroy($id)
    {
        $this->Userrepo -> destroy($id);
    }
    public function update($id,array $User_data)
    {
        $this->Userrepo -> update($id,$User_data);
    }
   
}
