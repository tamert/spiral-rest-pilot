<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Job\Ping;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;


class HomeController
{
    use PrototypeTrait;

    /**
     * @Route(route="/", name="index", methods={"GET"})
     * @return string
     */
    public function index(): string
    {
        return $this->views->render('home.dark.php');
    }

    /**
     * @return string
     */
    public function ping(): string
    {
        $jobID = $this->queue->push(Ping::class, [
            'value' => 'hello world',
        ]);

        return sprintf('Job ID: %s', $jobID);
    }
}
