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
     * @param int $statusCode Http stats code
     * @param string $message Exception message
     * @param \Exception $previous
     * @param array $headers
     * @param int $code
     */
    public function __construct(
        int $statusCode = 500,
        string $message = 'Internal Server Error',
        \Exception $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
