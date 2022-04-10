<?php
/**
 * 快捷方式 接口
 */
declare(strict_types=1);

namespace abxk\contract;

interface ShortcutInterface
{
    /**
     * @param mixed $params
     * @return array
     */
    public function getPlugins($params): array;
}
