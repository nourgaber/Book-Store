<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use App\Constants\SuccessConstants;
use App\Services\ResponseService;
use App\Exceptions\CustomException;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store($name, $email, $password)
    {
        $user = $this->userRepository->store($name, $email, $password);
        $message = 'UserCreated';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccessData($responseMessage,$httpcode,$user);
    }
    public function show($id)
    {
        $user = $this->userRepository->show($id);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        $message = 'UserFound';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccessData($responseMessage,$httpcode,$user);
    }

    public function index()
    {
        return $this->userRepository->index();
    }
    public function destroy($id)
    {
        $user = $this->userRepository->destroy($id);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        $message = 'UserDeleted';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccess($responseMessage,$httpcode);
    }
    public function update($id,$name, $email)
    {
        $user = $this->userRepository->update($id,$name, $email);
        if (!$user) {
            throw new CustomException('USER_NOT_FOUND');
        }
        $message = 'UserUpdated';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccessData($responseMessage,$httpcode,$user);
    }

    
}
