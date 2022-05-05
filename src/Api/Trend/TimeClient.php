<?php

namespace RrEarring\BaiduTongji\Api\Trend;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class TimeClient
 * @package RrEarring\BaiduTongji\Api\Trend
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class TimeClient extends BaseClient
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
        'avg_visit_time',
        'avg_visit_pages',
        'trans_count',
        'trans_ratio',
        'avg_trans_cost',
        'income',
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
            'method'     => 'trend/time/a',
        ];

        return $this->http(array_merge($tmpParams, $params));
    }
}
