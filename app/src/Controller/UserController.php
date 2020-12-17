<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Spiral\Prototype\Traits\PrototypeTrait;


class UserController
{
    //use PrototypeTrait;

    public function getUser(int $id, UserRepository $userRepository): string
    {
        $user = $userRepository->findOne(["id" => $id]);

        return "get {$user->username}";
    }

    public function postUser(int $id): string
    {
        return "post {$id}";
    }

    public function deleteUser(int $id): string
    {
        return "delete {$id}";
    }

}
