<?php

declare(strict_types=1);

namespace abxk\exception;

use Throwable;

class ParamsException extends BaseException
{
    /**
     * Bootstrap.
     *
     * @param int $code
     * @param string $message
     * @param mixed $extra
     * @param Throwable|null $previous
     */
    public function __construct(int $code = self::PARAMS_ERROR, string $message = 'Params Error', $extra = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $extra, $previous);
    }
}
