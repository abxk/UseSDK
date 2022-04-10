<?php
/**
 * HTTP 客户端 服务发现
 */
declare(strict_types=1);

namespace abxk\service;

use abxk\Container;
use abxk\DS;
use GuzzleHttp\Client;
use abxk\contract\ConfigInterface;
use abxk\Contract\HttpClientInterface;
use abxk\Contract\ServiceProviderInterface;
use ReflectionException;

class HttpServiceProvider implements ServiceProviderInterface
{
    /**
     * @param array|null $data
     */
    public function register( ?array $data = null): void
    {
        /* @var DS $config */
        $config = Container::getInstance()->get(ConfigInterface::class);

        $service = new Client($config->get('http', []));

        Container::getInstance()->bind(HttpClientInterface::class, $service);
    }
}
