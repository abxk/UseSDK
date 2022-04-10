<?php

declare(strict_types=1);

namespace abxk;

use abxk\traits\Arrayable;
use abxk\traits\Serializable;
use ArrayAccess;
use abxk\traits\Accessable;
use JsonSerializable as JsonSerializableInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Serializable as SerializableInterface;

class Structure implements JsonSerializableInterface, SerializableInterface, ArrayAccess
{
    use Accessable;
    use Arrayable;
    use Serializable;

    /**
     * 请求
     * 实际上最终为一个 \Psr\Http\Message\RequestInterface 对象
     * @var RequestInterface|null
     */
    private $request = null;

    /**
     * 实际存储的就是输入的所有参数
     *
     * @var array
     */
    private $params = [];

    /**
     * 该属性类型为 \absk\DS，是 🚀 的 有效载荷， 实际存储的是所有需要请求给API供应商的所有参数。
     *
     * @var DS|null
     */
    private $payload = null;

    /**
     * 解析器
     * 实际的作用为：把控最终请求需要解包的类型
     *
     * @var string|null
     */
    private $parser = null;

    /**
     * 响应
     *
     * 实际作用为：最终返回的类
     *
     * 当 Parser 为 DSParser 时
     * Parser 最终返回的是 DS 对象
     *
     * 当 Parser 为 ResponseParser 时
     * Parser 最终返回的是 Response 对象
     *
     * 当 Parser 为 ArrayParser 时
     * Parser 最终返回的是 array 数组
     *
     * 当 Parser 为 JsonParser 时
     * Parser 最终返回的是 string
     *
     * 当 Parser 为 NoHttpRequestParser 时
     * Destination 最终返回的是 原样的 Request
     *
     * 当 Parser 为 OriginResponseParser 时
     * Destination 最终返回的是 ApiStructure 中的 DestinationOrigin
     *
     * @var DS|MessageInterface|array|null
     */
    private $response = null;

    /**
     * 原始响应
     * 实际作用为：当请求API供应商的 http 接口后的原始 Response
     *
     * @var MessageInterface|null
     */
    private $responseOrigin = null;

    /**
     * 获取 🚀 火箭的导航目的地
     *
     * @return RequestInterface|null
     *
     * @copyright  2022/2/25 11:56
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * 设置 🚀 火箭的导航目的地
     *
     * @param RequestInterface|null $request
     * @return Structure
     *
     * @copyright  2022/2/25 11:56
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setRequest(?RequestInterface $request): Structure
    {
        $this->request = $request;

        return $this;
    }

    /**
     * 获取存储的就是输入的所有参数
     *
     * @return array
     *
     * @copyright  2022/2/25 11:57
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * 设置存储的就是输入的所有参数
     *
     * @param array $params
     * @return $this
     *
     * @copyright  2022/2/25 11:57
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setParams(array $params): Structure
    {
        $this->params = $params;

        return $this;
    }

    /**
     * 合并存储的就是输入的所有参数
     *
     * @param array $params
     * @return $this
     *
     * @copyright  2022/2/25 11:58
     * @author: lixuecong <1126392029@qq.com>
     */
    public function mergeParams(array $params): Structure
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * 获取 所有需要请求给API供应商的所有参数。
     *
     * @return DS|null
     *
     * @copyright  2022/2/25 11:58
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getPayload(): ?DS
    {
        return $this->payload;
    }

    /**
     * 设置 所有需要请求给API供应商的所有参数。
     *
     * @param DS|null $payload
     * @return $this
     *
     * @copyright  2022/2/25 11:58
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setPayload(?DS $payload): Structure
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * 合并所有需要请求给API供应商的所有参数。
     *
     * @param array $payload
     * @return $this
     *
     * @copyright  2022/2/25 11:59
     * @author: lixuecong <1126392029@qq.com>
     */
    public function mergePayload(array $payload): Structure
    {
        if (empty($this->payload)) {
            $this->payload = new DS();
        }

        $this->payload = $this->payload->merge($payload);

        return $this;
    }

    /**
     * 获取解析器
     *
     * @return string|null
     *
     * @copyright  2022/2/25 12:00
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getParser(): ?string
    {
        return $this->parser;
    }

    /**
     * 设置解析器
     *
     * @param string|null $parser
     * @return $this
     *
     * @copyright  2022/2/25 12:00
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setParser(?string $parser): Structure
    {
        $this->parser = $parser;

        return $this;
    }


    /**
     * 获取🚀 的目的地
     *
     * @return array|DS|MessageInterface|null
     *
     * @copyright  2022/2/25 12:00
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * 设置 🚀 的目的地
     *
     * @param  MessageInterface|DS|array|null $response
     * @return Structure
     *
     * @copyright  2022/2/25 12:01
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setResponse($response): Structure
    {
        $this->response = $response;

        return $this;
    }

    /**
     * 获取  🚀 的原始目的地。
     *
     * @return MessageInterface|null
     *
     * @copyright  2022/2/25 12:43
     * @author: lixuecong <1126392029@qq.com>
     */
    public function getResponseOrigin(): ?MessageInterface
    {
        return $this->responseOrigin;
    }

    /**
     * 设置 🚀 的原始目的地。
     *
     * @param MessageInterface|null $responseOrigin
     * @return $this
     *
     * @copyright  2022/2/25 12:44
     * @author: lixuecong <1126392029@qq.com>
     */
    public function setResponseOrigin(?MessageInterface $responseOrigin): Structure
    {
        $this->responseOrigin = $responseOrigin;

        return $this;
    }

}

