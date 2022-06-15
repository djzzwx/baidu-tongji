<?php

namespace RrEarring\BaiduTongji\Api\Site;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Site
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['list'] = function ($app) {
            return new ListClient($app);
        };
    }
}
