<?php
/**
 * 请求数据结构
 */
declare(strict_types=1);

namespace abxk;

use abxk\traits\Accessable;
use abxk\traits\Arrayable;
use abxk\traits\Serializable;
use JsonSerializable as JsonSerializableInterface;
use Serializable as SerializableInterface;

class Request extends \GuzzleHttp\Psr7\Request implements JsonSerializableInterface, SerializableInterface
{
    use Accessable;
    use Arrayable;
    use Serializable;


    public function toArray(): array
    {
        return [
            'url' => $this->getUri()->__toString(),
            'method' => $this->getMethod(),
            'headers' => $this->getHeaders(),
            'body' => $this->getBody()->getContents(),
        ];
    }
}
