<?php

namespace RrEarring\BaiduTongji\Tests\Traits;

/**
 * Class Date
 * @package RrEarring\BaiduTongji\Tests\Traits
 *
 * @author rr-earring <rr_earring@sina.com>
 */
trait DateTrait
{
    /**
     *
     * @return false|string
     *
     */
    public function start()
    {
        return date('Y0101');
    }

    /**
     *
     * @return false|string
     *
     */
    public function end()
    {
        return date('Y1231');
    }
}