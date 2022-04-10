<?php
/**
 *  服务 供给 接口
 */
declare(strict_types=1);

namespace abxk\contract;

interface ServiceProviderInterface
{
    /**
     * register the service.
     * @param array|null $data
     */
    public function register( ?array $data = null): void;
}
