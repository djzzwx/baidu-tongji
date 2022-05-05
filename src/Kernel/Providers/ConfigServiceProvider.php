<?php

namespace RrEarring\BaiduTongji\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RrEarring\BaiduTongji\Kernel\Contracts\Config;

/**
 * Class ConfigServiceProvider
 * @package RrEarring\BaiduTongji\Kernel\Providers
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}