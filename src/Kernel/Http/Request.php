<?php

namespace RrEarring\BaiduTongji\Kernel\Http;

use function GuzzleHttp\choose_handler;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;
use RrEarring\BaiduTongji\Kernel\Exceptions\InvalidArgumentException;
use RrEarring\BaiduTongji\Kernel\Exceptions\InvalidConfigException;
use RrEarring\BaiduTongji\Kernel\Support\Collection;

/**
 * Class Request
 * @package RrEarring\BaiduTongji\Kernel\Http
 */
class Request
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var HandlerStack
     */
    protected $handlerStack;

    /**
     * @var array
     */
    protected static $defaults = [];

    /**
     * @param array $defaults
     */
    public static function setDefaultOptions($defaults = [])
    {
        self::$defaults = $defaults;
    }

    /**
     * @return array
     */
    public static function getDefaultOptions()
    {
        return self::$defaults;
    }

    /**
     * @param ClientInterface $client
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @return Client|ClientInterface
     */
    public function getHttpClient()
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            if (property_exists($this, 'app') && isset($this->app['http_client'])) {
                $this->httpClient = $this->app['http_client'];
            } else {
                $this->httpClient = new Client(['handler' => choose_handler()]);
            }
        }

        return $this->httpClient;
    }

    /**
     * Add a middleware.
     *
     * @param callable $middleware
     * @param string|null $name
     * @return $this
     */
    public function pushMiddleware(callable $middleware, $name = null)
    {
        if (is_null($name)) {
            array_push($this->middlewares, $middleware);
        } else {
            $this->middlewares[$name] = $middleware;
        }

        return $this;
    }

    /**
     * Get all middlewares.
     *
     * @return array
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * Make a request.
     *
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function request($url, $method = 'GET', array $options = [])
    {
        $response = $this->getHttpClient()->request(
            strtoupper($method),
            $url,
            $this->fixJsonIssue(
                array_merge(
                    self::$defaults,
                    $options,
                    ['handler' => $this->getHandlerStack()]
                )
            )
        );

        $response->getBody()->rewind();

        return $response;
    }

    /**
     * @param HandlerStack $handlerStack
     */
    public function setHandlerStack(HandlerStack $handlerStack)
    {
        $this->handlerStack = $handlerStack;
    }

    /**
     * Build a handler stack.
     * @return HandlerStack
     */
    public function getHandlerStack()
    {
        if (!is_null($this->handlerStack)) {
            return $this->handlerStack;
        }

        $this->handlerStack = HandlerStack::create(choose_handler());

        foreach ($this->getMiddlewares() as $name => $middleware) {
            $this->handlerStack->push($middleware, $name);
        }

        return $this->handlerStack;
    }

    /**
     * @param array $options
     * @return array
     */
    public function fixJsonIssue(array $options)
    {
        if (isset($options['json']) && is_array($options['json'])) {
            $options['headers'] = array_merge(
                isset($options['headers']) ? $options['headers'] : [],
                ['Content-Type' => 'application/json']
            );

            if (empty($options['json'])) {
                $options['body'] = \Guzzlehttp\json_encode($options['json'], JSON_FORCE_OBJECT);
            } else {
                $options['body'] = $this->app->config->get('is_business')
                    ? \GuzzleHttp\json_encode(array_merge($this->getHeaderOption(), $this->getBodyOption($options['json'])), JSON_UNESCAPED_UNICODE)
                    : \GuzzleHttp\json_encode($options['json'], JSON_UNESCAPED_UNICODE);
            }

            unset($options['json']);
        }

        return $options;
    }

    /**
     * @return array
     */
    private function getHeaderOption()
    {
        return [
            'header' => [
                'username' => $this->app['config']->get('username'),
                'password' => $this->app['config']->get('password'),
                'token' => $this->app['config']->get('token'),
                'account_type' => $this->app['config']->get('account_type'),
            ]
        ];
    }

    /**
     * @param array $options
     *
     * @return array
     */
    private function getBodyOption(array $options)
    {
        return [
            'body' => array_merge(
                $options['json'], [
                    'site_id' => $this->app['config']->get('site_id')
                ]
            ),
        ];
    }

    /**
     * @param ResponseInterface $response
     * @param null $type
     *
     * @return array|Response|Collection|object|ResponseInterface
     *
     * @throws InvalidConfigException
     */
    protected function castResponseToType(ResponseInterface $response, $type = null)
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        $targetType = !is_null($type) ? $type : 'array';

        switch ($targetType) {
            case 'collection':
                return $response->toCollection();
            case 'array':
                return $response->toArray();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, \ArrayAccess::class)) {
                    throw new InvalidConfigException(
                        sprintf(
                            'Config key "response_type" classname must be an instanceof %s',
                            \ArrayAccess::class
                        )
                    );
                }

                return new $type($response);
        }
    }

    /**
     * @param mixed $response
     * @param string|null $type
     *
     * @return array|Response|Collection|object|ResponseInterface
     *
     * @throws InvalidConfigException
     * @throws InvalidArgumentException
     */
    protected function detectAndCastResponseToType($response, $type = null)
    {
        switch (true) {
            case $response instanceof ResponseInterface:
                $response = Response::buildFromPsrResponse($response);

                break;
            case $response instanceof \ArrayAccess:
                $response = new Response(200, [], json_encode($response->toArray()));

                break;
            case ($response instanceof Collection) || is_array($response) || is_object($response):
                $response = new Response(200, [], json_encode($response));

                break;
            case is_scalar($response):
                $response = new Response(200, [], $response);

                break;
            default:
                throw new InvalidArgumentException(sprintf('Unsupported response type "%s"', gettype($response)));
        }

        return $this->castResponseToType($response, $type);
    }
}
