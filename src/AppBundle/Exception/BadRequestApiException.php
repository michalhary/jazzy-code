<?php

namespace AppBundle\Exception;

/**
 * Not Found Api Exception. Message is returned by API
 */
class BadRequestApiException extends ApiException
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $message = 'Bad Request',
        int $statusCode = 400,
        \Exception $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}
