<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\News;
use App\Repository\NewsRepository;
use App\View\Endpoint\NewsView;
use App\View\Grid\NewsGrid;
use Spiral\DataGrid\GridFactory;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Psr\Http\Message\ResponseInterface;

class NewsController
{
    use PrototypeTrait;

    /**
     * @param GridFactory $grids
     * @param NewsRepository $newsRepository
     * @param NewsView $newsView
     * @param NewsGrid $newsGrid
     * @return array[]
     * @throws \Exception
     */
    public function index(GridFactory $grids, NewsRepository $newsRepository, NewsView $newsView, NewsGrid $newsGrid): array
    {

        $grid = $grids->create($newsRepository->findAllWithAuthor(), $newsGrid);

        return [
            'data' => array_map(
                [$newsView, 'map'],
                iterator_to_array($grid->getIterator())
            )
        ];
    }

    /**
     * @param int $id
     * @param NewsRepository $newsRepository
     * @param NewsView $newsView
     * @return ResponseInterface
     */
    public function getNews(int $id, NewsRepository $newsRepository, NewsView $newsView): ResponseInterface
    {
        $news = $newsRepository->findOne(["id" => $id]);

        if ($news instanceof News) {
            return $newsView->json($news);
        }

        throw new NotFoundException();
    }

    public function postNews(int $id): string
    {
        return "post {$id}";
    }

    public function deleteNews(int $id): string
    {
        return "delete {$id}";
    }

}
