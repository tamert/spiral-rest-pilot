<?php

declare(strict_types=1);

namespace App\View\Endpoint;

use App\Database\User;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="newsView")
 */
class UserView implements SingletonInterface
{
    /** @var ResponseWrapper */
    private $response;

    /**
     * @param ResponseWrapper $response
     */
    public function __construct(ResponseWrapper $response)
    {
        $this->response = $response;
    }

    public function map(User $news): array
    {
        return [
            'data' => [
                'id' => $news->id,
                'username' => $news->username,
                'email' => $news->email,
            ]
        ];
    }

    public function json(User $news): ResponseInterface
    {
        return $this->response->json($this->map($news), 200);
    }
}
