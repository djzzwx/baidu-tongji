<?php

namespace RrEarring\BaiduTongji\Kernel\Contracts;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;

/**
 * Class AccessToken
 * @package RrEarring\BaiduTongji\Kernel\Contracts
 */
class AccessToken
{
    /**
     * access_token
     *
     * @var string
     */
    protected $accessToken = '';

    /**
     * AccessToken constructor.
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        if (!$this->accessToken = $app->config->get('access_token')) {
            $this->getAccessToken();
        }
    }

    /**
     * @param $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get the requests params.
     *
     * @param RequestInterface $request
     *
     * @return array
     */
    public function getParams(RequestInterface $request)
    {
        $querystring = ('GET' === $request->getMethod())
            ? $request->getUri()->getQuery()
            : $request->getBody()->getContents();

        parse_str($querystring, $params);

        return $params;
    }

    /**
     * Applying app access_token to requests.
     *
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    public function applyAccessTokenToRequest(RequestInterface $request)
    {
        return $this->applyParamsToRequest(
            $request,
            $this->getParams($request),
            ['access_token' => $this->getAccessToken()]
        );
    }

    /**
     * Applying params to requests.
     *
     * @param RequestInterface $request
     * @param array $params
     * @param array $appends
     *
     * @return RequestInterface
     */
    public function applyParamsToRequest(RequestInterface $request, array $params = [], array $appends = [])
    {
        $querystring = http_build_query(array_merge($params, $appends));

        return ('GET' == $request->getMethod())
            ? $request->withUri($request->getUri()->withQuery($querystring))
            : $request->withBody(Utils::streamFor($querystring));
    }
}