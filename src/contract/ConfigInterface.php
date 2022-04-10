<?php
/**
 * 配置接口
 *
 * @copyright  2022/2/23 13:00
 * @author: lixuecong <1126392029@qq.com>
 */
declare(strict_types=1);


namespace abxk\contract;



interface ConfigInterface
{
    /**
     * @param string $key
     * @param mixed $default default value of the entry when does not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    public function has(string $key): bool;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value);
}
