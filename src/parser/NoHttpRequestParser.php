<?php

declare(strict_types=1);

namespace abxk\parser;

use abxk\contract\ParserInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * 非 Http 请求
 */
class NoHttpRequestParser implements ParserInterface
{
    public function parse(?ResponseInterface $response): ?ResponseInterface
    {
        return $response;
    }
}
