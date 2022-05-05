<?php

namespace RrEarring\BaiduTongji\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RrEarring\BaiduTongji\Kernel\Contracts\Middleware;

/**
 * Class MiddlewareServiceProvider
 * @package RrEarring\BaiduTongji\Kernel\Providers
 */
class MiddlewareServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['middleware'] = function ($app) {
            return new Middleware($app);
        };
    }
}