<?php

namespace CHRobinson\Http;

class HttpResponse
{
    public $statusCode;
    public $result;
    public $headers;

    public function __construct($statusCode, $body, $headers)
    {
        $this->setStatusCode($statusCode);
        $this->headers = $headers;
        $this->result = $body;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return (int) $this->statusCode;
    }

    public function setResult($result)
    {
        if (is_array($result) || is_string($result)) {
            $this->result = $result;
        }
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}
