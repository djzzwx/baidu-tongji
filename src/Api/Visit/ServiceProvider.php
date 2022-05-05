<?php

namespace RrEarring\BaiduTongji\Api\Visit;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Visit
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
        $app['toppage'] = function ($app) {
            return new ToppageClient($app);
        };

        $app['topdomain'] = function ($app) {
            return new TopdomainClient($app);
        };

        $app['landingpage'] = function ($app) {
            return new LandingpageClient($app);
        };

        $app['district'] = function ($app) {
            return new DistrictClient($app);
        };

        $app['world'] = function ($app) {
            return new WorldClient($app);
        };
    }
}
