<?php

namespace RrEarring\BaiduTongji\Api\Site;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class ListClient
 * @package RrEarring\BaiduTongji\Api\Site
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
class ListClient extends BaseClient
{
    /**
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function get()
    {
        return $this->http([]);
    }
}
