<?php

namespace RrEarring\BaiduTongji\Api\Custom;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Custom
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['media'] = function ($app) {
            return new MediaClient($app);
        };
    }
}
