<?php

namespace RrEarring\BaiduTongji\Api\Trend;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Trend
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
        $app['time'] = function ($app) {
            return new TimeClient($app);
        };

        $app['latest'] = function ($app) {
            return new LatestClient($app);
        };
    }
}
