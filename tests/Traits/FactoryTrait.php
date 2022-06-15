<?php

namespace RrEarring\BaiduTongji\Tests\Traits;

use RrEarring\BaiduTongji\Factory as TongjiFactory;

/**
 * trait Factory
 * @package RrEarring\BaiduTongji\Tests\Traits
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
trait FactoryTrait
{
    /**
     * @var null
     */
    static $instance = null;

    /**
     *
     * @return \RrEarring\BaiduTongji\Api\Application|null
     *
     */
    public function getApiInstance()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = TongjiFactory::baiduApi(self::$config);
    }
}