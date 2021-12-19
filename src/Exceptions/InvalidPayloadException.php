<?php

namespace OSSTools\LibreTranslate\Exceptions;

use Exception;
use Throwable;

class InvalidPayloadException extends Exception
{
    public function __construct($message = 'The supplied payload must be a string or an array', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
