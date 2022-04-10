<?php

declare(strict_types=1);

namespace abxk\exception;

use Throwable;

class ServiceException extends BaseException
{
    /**
     * Bootstrap.
     *
     * @param string $message
     * @param int $code
     * @param mixed $extra
     * @param Throwable|null $previous
     */
    public function __construct(string $message = 'Service Error', int $code = self::SERVICE_ERROR, $extra = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $extra, $previous);
    }
}
