<?php

namespace RrEarring\BaiduTongji\Api\Visit;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class TopdomainClient
 * @package RrEarring\BaiduTongji\Api\Visit
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class TopdomainClient extends BaseClient
{
    /**
     * @var array
     */
    private $metrics = [
        'pv_count',
        'pv_ratio',
        'visit_count',
        'visitor_count',
        'new_visitor_count',
        'new_visitor_ratio',
        'ip_count',
        'average_stay_time',
        'avg_visit_pages',
    ];

    /**
     * @param $start
     * @param $end
     * @param string $metrics
     * @param array $params
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function get($start, $end, $metrics = '', array $params = [])
    {
        $tmpParams = [
            'start_date' => $start,
            'end_date'   => $end,
            'metrics'    => '' === $metrics ? implode(',', $this->metrics) : $metrics,
            'method'     => 'visit/topdomain/a',
        ];

        return $this->http(array_merge($tmpParams, $params));
    }
}
