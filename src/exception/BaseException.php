<?php

declare(strict_types=1);

namespace abxk\exception;

use RuntimeException;
use Throwable;

class BaseException extends RuntimeException
{
    public const UNKNOWN_ERROR = 9999;

    /**
     * 关于容器的服务.
     */
    public const SERVICE_ERROR = 2000;

    /**
     * 关于配置.
     */
    public const CONFIG_ERROR = 3000;

    public const HTTP_CLIENT_CONFIG_ERROR = 3004;

    /**
     * 关于参数.
     */
    public const PARAMS_ERROR = 4000;

    public const SHORTCUT_NOT_FOUND = 4001;

    public const PLUGIN_ERROR = 4002;


    /**
     * 关于api.
     */
    public const RESPONSE_ERROR = 5000;

    public const REQUEST_RESPONSE_ERROR = 5001;

    public const UNPACK_RESPONSE_ERROR = 5002;

    public const INVALID_RESPONSE_CODE = 5004;

    public const RESPONSE_NONE = 5006;

    /**
     * raw.
     *
     * @var mixed
     */
    public $extra = null;

    /**
     * Bootstrap.
     *
     * @param string $message
     * @param int $code
     * @param mixed $extra
     * @param Throwable|null $previous
     */
    public function __construct(string $message = 'Unknown Error', int $code = self::UNKNOWN_ERROR, $extra = null, Throwable $previous = null)
    {
        $this->extra = $extra;

        parent::__construct($message, $code, $previous);
    }
}
