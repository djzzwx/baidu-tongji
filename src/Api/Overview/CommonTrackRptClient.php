<?php

namespace RrEarring\BaiduTongji\Api\Overview;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class CommonTrackRptClient
 * @package RrEarring\BaiduTongji\Api\Overview
 *
 * @author rr-earring <ahwei000001@gmail.com>
 */
class CommonTrackRptClient extends BaseClient
{
    /**
     * @param $start
     * @param $end
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function get($start, $end)
    {
        $params = [
            'start_date' => $start,
            'end_date'   => $end,
            'method'     => 'overview/getCommonTrackRpt',
        ];

        return $this->http($params);
    }
}
