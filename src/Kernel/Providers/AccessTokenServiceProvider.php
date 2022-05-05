<?php

namespace RrEarring\BaiduTongji\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RrEarring\BaiduTongji\Kernel\Contracts\AccessToken;

/**
 * Class AccessTokenServiceProvider
 * @package RrEarring\BaiduTongji\Kernel\Providers
 */
class AccessTokenServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['access_token'] = function ($app) {
            return new AccessToken($app);
        };
    }
}