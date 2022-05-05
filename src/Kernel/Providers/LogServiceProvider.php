<?php

namespace RrEarring\BaiduTongji\Kernel\Providers;

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RrEarring\BaiduTongji\Kernel\Exceptions\Exception;
use RrEarring\BaiduTongji\Kernel\Contracts\ServiceContainer;

/**
 * Class LogServiceProvider
 * @package RrEarring\BaiduTongji\Kernel\Providers
 */
class LogServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['logger'] = function ($app) {
            $logger = new Logger($app->config->get('log.name'));

            $logger->pushHandler($this->getDefaultHandler($app));

            return $logger;
        };
    }

    /**
     * @param ServiceContainer $app
     * @return RotatingFileHandler
     * @throws Exception
     */
    public function getDefaultHandler(ServiceContainer $app)
    {
        $handler = new RotatingFileHandler(
            $app->config->get('log.file', sprintf('%s/logs/%s.log', \sys_get_temp_dir(), $app->config->get('log.name', 'baidu-tongji.log'))),
            $app->config->get('log.days', 7),
            $this->level($app->config->get('log.level', 'DEBUG'))
        );

        $handler->setFormatter($this->getLineFormatter());

        return $handler;
    }

    /**
     * @param $level
     * @return int
     * @throws Exception
     */
    public function level($level)
    {
        $level = Logger::toMonologLevel(strval($level));

        if (is_int($level)) {
            return $level;
        }

        throw new Exception('Invalid log level.');
    }

    /**
     * @return LineFormatter
     */
    public function getLineFormatter()
    {
        return new LineFormatter(null, null, true, true);
    }
}
