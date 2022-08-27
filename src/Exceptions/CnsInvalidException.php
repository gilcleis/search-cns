<?php

namespace Gilclei\SearchCns\Exceptions;

class CnsInvalidException extends \Exception
{
    public function __construct($message, $code = 98, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // public function __toString()
    // {
    //     return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    // }
}
