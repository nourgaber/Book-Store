<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use App\Constants\SuccessConstants;
use App\Services\ResponseService;
use App\Exceptions\CustomException;
/**
 * Class UserService
 * @package App\Services
 */
class PasswordresetService
{
    protected $Userrepo;
    protected $PasswordResetRepo;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $Userrepo, PasswordResetRepository $PasswordResetRepo)
    {
        $this->Userrepo = $Userrepo;
        $this->PasswordResetRepo = $PasswordResetRepo;
    }

    public function create($email)
    {
        $user = $this->Userrepo->showUserByemail($email);
        if (!$user) {
            throw new CustomException('Email_NOT_FOUND');
        }
        $passwordReset = $this->PasswordResetRepo->getPasswordReset($user);
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        }

        return true;
    }
    public function find($token)
    {
        $passwordReset = $this->PasswordResetRepo->FindByToken($token);
        if (!$passwordReset) {
            throw new CustomException('ResetTokenInvalid');
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            throw new CustomException('ResetTokenInvalid');
        }
        return $passwordReset;
    }

    public function reset($token, $email, $password)
    {

        $passwordReset = $this->PasswordResetRepo->findbyTokenEmail($token, $email);
        if (!$passwordReset) {
            throw new CustomException('ResetTokenInvalid');
        }
        $user = $this->Userrepo->showUserByemail($passwordReset->email);
        if (!$user) {
            throw new CustomException('Email_NOT_FOUND');
        }

        $user->password = bcrypt($password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return $user;
    }
}
