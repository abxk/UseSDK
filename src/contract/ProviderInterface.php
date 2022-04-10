<?php
/**
 * 数据供给器 接口
 */
declare(strict_types=1);

namespace abxk\contract;

use abxk\DS;
use Psr\Http\Message\MessageInterface;

interface ProviderInterface
{
    /**
     * run
     *
     *
     * @param array $plugins
     * @param array $params
     * @return MessageInterface|DS|array|null
     */
    public function run(array $plugins, array $params);

}
