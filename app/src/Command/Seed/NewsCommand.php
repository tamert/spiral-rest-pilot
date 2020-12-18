<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Command\Seed;

use App\Database\News;
use App\Repository\UserRepository;
use Cycle\ORM\TransactionInterface;
use Faker\Factory;
use Spiral\Console\Command;

class NewsCommand extends Command
{
    protected const NAME = 'seed:news';


    protected function perform(TransactionInterface $tr, UserRepository $userRepository): void
    {
        $faker = Factory::create();
        $user = $userRepository->findOne(['id' => 112]);
        for ($i = 0; $i < 5; $i++) {
            $news = new News();
            $news->title = $faker->title();
            $news->content = $faker->text(250);
            $news->author = $user;
            $tr->persist($news);
        }

        $tr->run();
    }
}
