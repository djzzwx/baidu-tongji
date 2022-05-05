<?php

namespace RrEarring\BaiduTongji\Tests\Api\Trend;

use RrEarring\BaiduTongji\Tests\Abstracts\TestCase;
use RrEarring\BaiduTongji\Tests\Traits\ConfigTrait;
use RrEarring\BaiduTongji\Tests\Traits\FactoryTrait;
use RrEarring\BaiduTongji\Tests\Traits\DateTrait;

/**
 * Class ListTest
 * @package RrEarring\BaiduTongji\Tests\Api\Trend
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class TimeTest extends TestCase
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
        $data = $this->getApiInstance()->time->get('area,searchword,visit_time,visit_pages', 'visit_pages,desc', 100, ['source' => 'through', 'area' => 'china']);

        $this->assertIsArray($data);

        return $data;
    }
}