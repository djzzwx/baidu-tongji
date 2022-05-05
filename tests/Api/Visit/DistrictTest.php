<?php

namespace RrEarring\BaiduTongji\Tests\Api\Visit;

use RrEarring\BaiduTongji\Tests\Abstracts\TestCase;
use RrEarring\BaiduTongji\Tests\Traits\ConfigTrait;
use RrEarring\BaiduTongji\Tests\Traits\FactoryTrait;
use RrEarring\BaiduTongji\Tests\Traits\DateTrait;

/**
 * Class ListTest
 * @package RrEarring\BaiduTongji\Tests\Api\Visit
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class DistrictTest extends TestCase
{
    use ConfigTrait, FactoryTrait, DateTrait;

    /**
     *
     * @return array|mixed|object|\Psr\Http\Message\ResponseInterface|\RrEarring\BaiduTongji\Kernel\Http\Response|\RrEarring\BaiduTongji\Kernel\Support\Collection
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function testData()
    {
        $data = $this->getApiInstance()->district->get($this->start(), $this->end(), 'pv_count,visit_count,visitor_count');

        $this->assertIsArray($data);

        return $data;
    }
}