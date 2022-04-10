<?php

declare(strict_types=1);

namespace abxk\parser;

use abxk\contract\ParserInterface;
use abxk\exception\BaseException;
use abxk\exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 * 数组解析器
 */
class ArrayParser implements ParserInterface
{
    /**
     * @param ResponseInterface|null $response
     * @return array
     * @throws ResponseException
     */
    public function parse(?ResponseInterface $response): array
    {
        if (is_null($response)) {
            throw new ResponseException(BaseException::RESPONSE_NONE);
        }

        $contents = $response->getBody()->getContents();

        $result = json_decode($contents, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new ResponseException(BaseException::UNPACK_RESPONSE_ERROR, 'Unpack Response Error', ['contents' => $contents, 'response' => $response]);
        }

        return $result;
    }
}
