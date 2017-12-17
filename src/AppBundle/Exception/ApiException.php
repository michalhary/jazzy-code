<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Api Exception. Message is returned by API
 */
class ApiException extends HttpException
{
    /**
     * Constructor
     *
     * @param string $message Exception message
     * @param int $statusCode Http stats code
     * @param \Exception $previous
     * @param array $headers
     * @param int $code
     */
    public function __construct(
        string $message = 'Internal Server Error',
        int $statusCode = 500,
        \Exception $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
