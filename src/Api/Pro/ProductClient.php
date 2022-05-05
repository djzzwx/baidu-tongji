<?php

namespace RrEarring\BaiduTongji\Api\Pro;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class ProductClient
 * @package RrEarring\BaiduTongji\Api\Pro
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class ProductClient extends BaseClient
{
    /**
     * 注：仅百度商业账号的推广类账号可用
     */

    /**
     * @var array
     */
    private $metrics = [
        'show_count',
        'clk_count',
        'cost_count',
        'ctr',
        'cpm',
        'pv_count',
        'visit_count',
        'visitor_count',
        'new_visitor_count',
        'new_visitor_ratio',
        'in_visit_count',
        'bounce_ratio',
        'avg_visit_time',
        'avg_visit_pages',
        'arrival_ratio',
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
            'method'     => 'pro/product/a',
        ];

        return $this->http(array_merge($tmpParams, $params));
    }
}
