<?php

namespace RrEarring\BaiduTongji\Api\Source;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Source
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
        $app['all'] = function ($app) {
            return new AllClient($app);
        };

        $app['engine'] = function ($app) {
            return new EngineClient($app);
        };

        $app['searchword'] = function ($app) {
            return new SearchwordClient($app);
        };

        $app['link'] = function ($app) {
            return new LinkClient($app);
        };
    }
}
