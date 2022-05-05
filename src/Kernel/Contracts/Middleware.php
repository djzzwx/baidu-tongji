<?php

namespace RrEarring\BaiduTongji\Kernel\Contracts;


use Pimple\Container;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware as GuzzleMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LogLevel;
use RrEarring\BaiduTongji\Kernel\Support\Collection;

/**
 * Class Middleware
 *
 * @package RrEarring\BaiduTongji\Kernel\Contracts
 */
class Middleware extends Collection
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    public function __construct(Container $app, array $items = [])
    {
        parent::__construct($items);
        $this->app = $app;
    }

    /**
     * @param BaseClient $client
     */
    public function register(BaseClient $client)
    {
        $client->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Log the request.
     *
     * @return callable
     */
    protected function logMiddleware()
    {
        $template = $this->app->config->get('http.log_template', MessageFormatter::DEBUG);

        $formatter = new MessageFormatter($template);

        return GuzzleMiddleware::log($this->app->logger, $formatter, LogLevel::DEBUG);
    }

    /**
     * @param BaseClient $client
     */
    public function accessToken(BaseClient $client) {
        $client->pushMiddleware(function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $this->app->access_token->applyAccessTokenToRequest($request);

                return $handler($request, $options);
            };
        }, 'access_token');
    }
}