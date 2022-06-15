<?php

namespace RrEarring\BaiduTongji\Api;

use RrEarring\BaiduTongji\Kernel\Contracts\ServiceContainer;

/**
 * Class Application
 * @package RrEarring\BaiduMap\Api
 *
 * @property Overview\TimeTrendRptClient $time_trend_rpt
 * @property Overview\DistrictRptClient $district_rpt
 * @property Overview\CommonTrackRptClient $common_track_rpt
 * @property Trend\TimeClient $time
 * @property Trend\LatestClient $latest
 * @property Pro\ProductClient $product
 * @property Pro\HourClient $hour
 * @property Source\AllClient $all
 * @property Source\EngineClient $engine
 * @property Source\SearchwordClient $searchword
 * @property Source\LinkClient $link
 * @property Custom\MediaClient $media
 * @property Visit\ToppageClient $toppage
 * @property Visit\TopdomainClient $topdomain
 * @property Visit\LandingpageClient $landingpage
 * @property Visit\DistrictClient $district
 * @property Visit\WorldClient $world
 * @property Site\ListClient $list
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
class Application extends ServiceContainer
{
    protected $providers = [
        Overview\ServiceProvider::class,
        Trend\ServiceProvider::class,
        Pro\ServiceProvider::class,
        Source\ServiceProvider::class,
        Custom\ServiceProvider::class,
        Visit\ServiceProvider::class,
        Site\ServiceProvider::class,
    ];
}