<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\User;
use App\Repository\UserRepository;
use App\View\Endpoint\UserView;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Spiral\Prototype\Traits\PrototypeTrait;
use Psr\Http\Message\ResponseInterface;

class UserController
{
    use PrototypeTrait;

    public function getUser(int $id, UserRepository $userRepository, UserView $userView): ResponseInterface
    {
        $user = $userRepository->findOne(["id" => $id]);
        if ($user instanceof User) {
            return $userView->json($user);
        }
        throw new NotFoundException();
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
