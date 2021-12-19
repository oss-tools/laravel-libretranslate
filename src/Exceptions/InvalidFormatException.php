<?php

namespace OSSTools\LibreTranslate\Exceptions;

use Exception;
use Throwable;

class InvalidFormatException extends Exception
{
    public function __construct($message = 'The requested format is invalid', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
