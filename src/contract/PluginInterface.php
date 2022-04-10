<?php
/**
 * 插件 接口
 */
declare(strict_types=1);

namespace abxk\contract;

use abxk\Structure;
use Closure;

interface PluginInterface
{
    public function assembly(Structure $rocket, Closure $next): Structure;
}
