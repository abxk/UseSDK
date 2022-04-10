<?php
/**
 * 解析器 接口
 */
declare(strict_types=1);

namespace abxk\contract;

use Psr\Http\Message\ResponseInterface;

interface ParserInterface
{
    /**
     * 解析数据
     * @param ResponseInterface|null $response
     * @return mixed
     */
    public function parse(?ResponseInterface $response);
}
