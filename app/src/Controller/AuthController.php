<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Request\LoginRequest;
use Spiral\Prototype\Traits\PrototypeTrait;

class AuthController
{
    use PrototypeTrait;

    /**
     * @param LoginRequest $login
     * @param UserRepository $userRepository
     * @return array
     * @throws \Spiral\Models\Exception\EntityExceptionInterface
     */
    public function postLogin(LoginRequest $login, UserRepository $userRepository)
    {
        if (!$login->isValid()) {
            return [
                'status' => 400,
                'errors' => $login->getErrors()
            ];
        }

        // application specific login logic
        $user = $userRepository->findOne(['username' => $login->getField('username')]);
        if (
            $user === null
            || !password_verify($login->getField('password'), $user->password)
        ) {
            return [
                'status' => 400,
                'error'  => 'No such user'
            ];
        }

        // todo jwt token

        return [
            'status'  => 200,
            'message' => 'Authenticated!'
        ];
    }


}
