<?php

namespace CHRobinson\Http;

class HttpException extends IOException
{
    public $statusCode;
    public $headers;

    public function __construct($message, $statusCode, $headers)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
