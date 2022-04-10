<?php

declare(strict_types=1);

namespace abxk\exception;

use Throwable;

class ConfigException extends BaseException
{
    /**
     * Bootstrap.
     *
     * @param int $code
     * @param string $message
     * @param mixed $extra
     * @param Throwable|null $previous
     */
    public function __construct(int $code = self::CONFIG_ERROR, string $message = 'Config Error', $extra = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $extra, $previous);
    }
}
