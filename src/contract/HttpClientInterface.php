<?php
/**
 * HTTP 客户端接口
 */
declare(strict_types=1);

namespace abxk\contract;

use GuzzleHttp\ClientInterface;

interface HttpClientInterface extends ClientInterface, \Psr\Http\Client\ClientInterface
{
}
