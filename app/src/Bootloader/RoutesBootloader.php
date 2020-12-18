<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Bootloader;

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\NewsController;
use App\Controller\UserController;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Router\Route;
use Spiral\Router\RouteInterface;
use Spiral\Router\RouterInterface;
use Spiral\Router\Target\Controller;
use Spiral\Router\Target\Namespaced;

class RoutesBootloader extends Bootloader
{
    const API = '/api';

    /**
     * Bootloader execute method.
     *
     * @param RouterInterface $router
     */
    public function boot(RouterInterface $router): void
    {
        // named route
        $router->setRoute(
            'html',
            new Route('/<action>.html', new Controller(HomeController::class))
        );

        $router->setRoute('user', new Route(
            self::API . '/user/<id:\d+>',
            new Controller(UserController::class, Controller::RESTFUL),
            ['action' => 'user']
        ));

        $router->setRoute('news', new Route(
            self::API . '/news/<id:\d+>',
            new Controller(NewsController::class, Controller::RESTFUL),
            ['action' => 'news']
        ));

        $router->setRoute('news.list', new Route(
            self::API . '/news',
            new Controller(NewsController::class),
            ['action' => 'index']
        ));

        $router->setRoute('auth', new Route(
            self::API . '/auth/login',
            new Controller(AuthController::class, Controller::RESTFUL),
            ['action' => 'login']
        ));

        // fallback (default) route
        $router->setDefault($this->defaultRoute());
    }

    /**
     * Default route points to namespace of controllers.
     *
     * @return RouteInterface
     */
    protected function defaultRoute(): RouteInterface
    {
        // handle all /controller/action like urls
        $route = new Route(
            '/[<controller>[/<action>]]',
            new Namespaced('App\\Controller')
        );

        return $route->withDefaults([
            'controller' => 'home',
            'action' => 'index',
        ]);
    }
}
