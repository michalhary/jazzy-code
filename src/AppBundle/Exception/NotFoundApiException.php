<?php

namespace AppBundle\Exception;

/**
 * Not Found Api Exception. Message is returned by API
 */
class NotFoundApiException extends ApiException
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $message = 'Not Found',
        int $statusCode = 404,
        \Exception $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}
