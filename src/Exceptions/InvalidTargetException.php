<?php

namespace OSSTools\LibreTranslate\Exceptions;

use Exception;
use Throwable;

class InvalidTargetException extends Exception
{
    public function __construct($message = 'The supplied target is invalid', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
