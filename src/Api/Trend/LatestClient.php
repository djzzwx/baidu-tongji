<?php

namespace RrEarring\BaiduTongji\Api\Trend;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class LatestClient
 * @package RrEarring\BaiduTongji\Api\Trend
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class LatestClient extends BaseClient
{
    /**
     * @var array
     */
    private $metrics = [
        'start_time',
        'area',
        'source',
        'access_page',
        'keyword',
        'searchword',
        'is_ad',
        'visitorId',
        'ip',
        'visit_time',
        'visit_pages',
    ];

    /**
     * @param string $metrics
     * @param string $order
     * @param string $maxResults
     * @param array $params
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function get($metrics = '', $order = '', $maxResults = '', array $params = [])
    {
        $tmpParams = [
            'metrics'    => '' === $metrics ? implode(',', $this->metrics) : $metrics,
            'method'     => 'trend/latest/a',
        ];

        if ('' !== $order) {
            $tmpParams['order'] = $order;
        }

        if ('' !== $maxResults) {
            $tmpParams['max_results'] = $maxResults;
        }

        return $this->http(array_merge($tmpParams, $params));
    }
}
