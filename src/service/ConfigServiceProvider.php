<?php
/**
 * 配置加载服务
 */
declare(strict_types=1);

namespace abxk\service;

use abxk\Container;
use abxk\contract\ConfigInterface;
use abxk\contract\ServiceProviderInterface;
use abxk\DS;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    private $config = [
        'http' => [
            'timeout' => 5.0,
            'connect_timeout' => 3.0,
        ]
    ];

    /**
     * @param array|null $data
     */
    public function register(?array $data = null): void
    {
        $config = new DS(array_replace_recursive($this->config, $data ?? []));

        Container::getInstance()->bind(ConfigInterface::class, $config);
        /* DS */
        Container::getInstance()->bind('config', $config);
    }
}
