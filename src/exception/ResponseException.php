<?php
/**
 * 无效请求异常
 */
declare(strict_types=1);

namespace abxk\exception;

use Throwable;

class ResponseException extends BaseException
{
    /**
     * @var Throwable|null
     */
    public $exception = null;

    /**
     * @var mixed
     */
    public $response = null;

    /**
     * Bootstrap.
     *
     * @param int $code
     * @param string $message
     * @param mixed $extra
     * @param Throwable|null $exception
     * @param Throwable|null $previous
     */
    public function __construct(
        int $code = self::RESPONSE_ERROR,
        string $message = 'Provider response Error',
        $extra = null,
        ?Throwable $exception = null,
        Throwable $previous = null)
    {
        $this->response = $extra;
        $this->exception = $exception;

        parent::__construct($message, $code, $extra, $previous);
    }
}
