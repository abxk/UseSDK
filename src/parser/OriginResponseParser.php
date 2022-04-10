<?php

declare(strict_types=1);

namespace abxk\parser;


use abxk\contract\ParserInterface;
use abxk\exception\BaseException;
use abxk\exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 * 原数据集请求解析器
 */
class OriginResponseParser implements ParserInterface
{
    /**
     * @param ResponseInterface|null $response
     * @return ResponseInterface|null
     * @throws ResponseException
     */
    public function parse(?ResponseInterface $response): ?ResponseInterface
    {
        if (!is_null($response)) {
            return $response;
        }

        throw new ResponseException(BaseException::INVALID_RESPONSE_CODE);
    }
}
