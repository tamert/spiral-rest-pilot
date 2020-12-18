<?php

declare(strict_types=1);

namespace App\View\Endpoint;

use App\Database\News;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="newsView")
 */
class NewsView implements SingletonInterface
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

    public function map(News $news): array
    {
        return [
            'data' => [
                'id' => $news->id,
                'author'  => [
                    'id'   => $news->author->id,
                    'name' => $news->author->name
                ],
                'title' => $news->title,
                'content' => $news->content,
            ]
        ];
    }

    public function json(News $news): ResponseInterface
    {
        return $this->response->json($this->map($news), 200);
    }
}
