<?php

namespace RrEarring\BaiduTongji\Api\Custom;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduTongji\Kernel\Contracts\BaseClient;
use RrEarring\BaiduTongji\Kernel\Support\Collection;
use RrEarring\BaiduTongji\Kernel\Http\Response;

/**
 * Class MediaClient
 * @package RrEarring\BaiduTongji\Api\Custom
 *
 * @author rr-earring <rr_earring@sina.com>
 */
class MediaClient extends BaseClient
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
        'bounce_ratio',
        'avg_visit_time',
        'avg_visit_pages',
        'trans_count',
        'trans_ratio',
    ];

    /**
     * flag参数可选项：
     *
     * from: 来源
     * plan: 计划
     * unit: 单元
     * word: 关键词
     * idea: 创意
     *
     * @var string
     */
    private $flag = 'plan';

    /**
     * @param $start
     * @param $end
     * @param string $metrics
     * @param string $flag
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws \RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException
     */
    public function get($start, $end, $metrics = '', $flag = '')
    {
        $params = [
            'start_date' => $start,
            'end_date'   => $end,
            'metrics'    => '' === $metrics ? implode(',', $this->metrics) : $metrics,
            'method'     => 'custom/media/a',
            'flag'       => '' === $flag ? $this->flag : $flag,
        ];

        return $this->http($params);
    }
}
