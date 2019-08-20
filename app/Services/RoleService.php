<?php
namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ResponseService;

/**
 * Class UserService
 * @package App\Services
 */
class RoleService
{
    protected $userRepository;
    protected $responseService;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository, ResponseService $responseService)
    {
        $this->userRepository = $userRepository;
        $this->responseService = $responseService;

    }

    public static function authorizeRoles($user, $roles)
    {
        if (is_array($roles)) {
            $result = RoleService::hasAnyRole($user, $roles);
            if ($result) {
                return $result;
            }
            throw new CustomException('UNAUTHORIZED_ROLE');
        }
        $result = RoleService::hasRole($user, $roles);
        if ($result) {
            return $result;
        }

        throw new CustomException('UNAUTHORIZED_ROLE');
    }

    public static function hasAnyRole($user, $roles)
    {
        return null !== $user->roles()->whereIn('name', $roles)->first();
    }

    public static function hasRole($user, $roles)
    {
        return null !== $user->roles()->where('name', $role)->first();
    }
}
