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
 * @author rr-earring <ahwei000001@gmail.com>
 */
class TopdomainTest extends TestCase
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
        $data = $this->getApiInstance()->topdomain->get($this->start(), $this->end(), 'visit_count,visitor_count');

        $this->assertIsArray($data);

        return $data;
    }
}