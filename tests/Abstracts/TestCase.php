<?php

namespace RrEarring\BaiduTongji\Tests\Abstracts;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /**
     *
     * @return mixed
     *
     */
    abstract public function testData();

    /**
     * @param array $data
     *
     * @depends testData
     *
     * @return mixed
     *
     */
    public function testDataStruct(array $data)
    {
        $this->assertArrayHasKey('header', $data);
        $this->assertArrayHasKey('body', $data);

        return $data['header'];
    }

    /**
     * @param array $data
     *
     * @depends testDataStruct
     *
     * @return mixed
     *
     */
    public function testHeaderStruct(array $data)
    {
        $this->assertArrayHasKey('desc', $data);

        return $data['desc'];
    }

    /**
     * @param $desc
     *
     * @depends testHeaderStruct
     */
    public function testResult($desc)
    {
        $this->assertEquals('success', $desc);
    }
}