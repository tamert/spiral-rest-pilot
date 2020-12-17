<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Command\Seed;

use App\Database\User;
use Cycle\ORM\TransactionInterface;
use Faker\Factory;
use Spiral\Console\Command;

class UserCommand extends Command
{
    protected const NAME = 'seed:user';

    protected function perform(TransactionInterface $tr): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = $faker->name();
            $user->username = $faker->userName;
            $user->email = $faker->safeEmail;
            $user->password = password_hash('secret', PASSWORD_DEFAULT);;
            $user->status = "active";

            $tr->persist($user);
        }

        $tr->run();
    }
}
