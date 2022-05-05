<?php

namespace RrEarring\BaiduTongji\Kernel\Contracts;

use Pimple\Container;
use RrEarring\BaiduTongji\Kernel\Providers\AccessTokenServiceProvider;
use RrEarring\BaiduTongji\Kernel\Providers\ConfigServiceProvider;
use RrEarring\BaiduTongji\Kernel\Providers\HttpClientServiceProvider;
use RrEarring\BaiduTongji\Kernel\Providers\MiddlewareServiceProvider;
use RrEarring\BaiduTongji\Kernel\Providers\LogServiceProvider;

/**
 * Class ServiceContainer
 * @package RrEarring\BaiduTongji\Kernel\Contracts
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultProviders = [
        ConfigServiceProvider::class,
        HttpClientServiceProvider::class,
        MiddlewareServiceProvider::class,
        LogServiceProvider::class,
        AccessTokenServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'business_url'      => 'https://api.baidu.com/json/tongji/v1/ReportService/getData',
        'personal_url'      => 'https://openapi.baidu.com/rest/2.0/tongji/report/getData',
        'business_list_url' => 'https://api.baidu.com/json/tongji/v1/ReportService/getSiteList',
        'personal_list_url' => 'https://openapi.baidu.com/rest/2.0/tongji/config/getSiteList',
        'account_type'      => 1
    ];

    /**
     * @var array
     */
    protected $httpConfig = [
        'http' => [
            'timeout'  => 10.0,
            'base_uri' => 'https://api.baidu.com/',
        ],
    ];

    /**
     * ServiceContainer constructor.
     * @param array $config
     * @param array $values
     */
    public function __construct(array $config, array $values = [])
    {
        parent::__construct($values);

        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return array_replace_recursive($this->httpConfig, $this->defaultConfig, $this->userConfig);
    }

    /**
     * @param array $providers
     */
    protected function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    /**
     * @return array
     */
    protected function getProviders()
    {
        return array_merge($this->defaultProviders, $this->providers);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

}