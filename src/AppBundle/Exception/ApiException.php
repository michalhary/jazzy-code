<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Api Exception. Message is returned by API
 */
class ApiException extends HttpException
{
    public function __construct(
        $statusCode = 500,
        $message = 'Internal Server Error',
        \Exception $previous = null,
        array $headers = [],
        $code = 0
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
