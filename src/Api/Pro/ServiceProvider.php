<?php

namespace RrEarring\BaiduTongji\Api\Pro;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Pro
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
        $app['product'] = function ($app) {
            return new ProductClient($app);
        };

        $app['hour'] = function ($app) {
            return new ProductClient($app);
        };
    }
}
