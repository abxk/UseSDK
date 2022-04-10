<?php

declare(strict_types=1);

namespace abxk\parser;

use abxk\Container;
use abxk\contract\ParserInterface;
use abxk\DS;
use Psr\Http\Message\ResponseInterface;

/**
 * DS 数据集解析器
 */
class DsParser implements ParserInterface
{
    /**
     * @param ResponseInterface|null $response
     * @return DS
     */
    public function parse(?ResponseInterface $response): DS
    {
        return new DS(
            Container::getInstance()->get(ArrayParser::class)->parse($response)
        );
    }
}
