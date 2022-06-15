<?php

namespace RrEarring\BaiduTongji\Api\Overview;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduTongji\Api\Overview
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
        $app['time_trend_rpt'] = function ($app) {
            return new TimeTrendRptClient($app);
        };

        $app['district_rpt'] = function ($app) {
            return new DistrictRptClient($app);
        };

        $app['common_track_rpt'] = function ($app) {
            return new CommonTrackRptClient($app);
        };
    }
}
