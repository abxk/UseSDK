<?php
/**
 * 通用方法
 *
 * @copyright  2022/2/25 17:52
 * @author: lixuecong <1126392029@qq.com>
 */


namespace abxk;

use abxk\parser\NoHttpRequestParser;


class Fun
{
    /**
     * 判断是否来自 HTTP 请求
     *
     * @param string|null $direction
     * @return bool
     *
     * @copyright  2022/2/25 17:40
     * @author: lixuecong <1126392029@qq.com>
     */
    public static function should_do_http_request(?string $direction): bool
    {
        return is_null($direction) ||
            (NoHttpRequestParser::class !== $direction &&
                !in_array(NoHttpRequestParser::class, class_parents($direction)));
    }
}

