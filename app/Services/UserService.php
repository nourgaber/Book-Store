<?php


namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;
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
        $this->Userrepo -> show($id);
    }
    public function get($User_id)
    {
       
    }
    public function all()
    {
        $this->Userrepo -> all();
    }
    public function destroy($id)
    {
        $this->Userrepo -> destroy($id);
    }
    public function update($id,array $User_data)
    {
        $this->Userrepo -> update($id,$User_data);
    }
    public function login($email,$password)
    {
        $this->Userrepo ->login( $email,$password);

    }
}
