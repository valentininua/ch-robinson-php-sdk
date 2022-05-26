<?php

namespace CHRobinson\Http;

class HttpRequest
{
    public $path;
    public $body;
    public $verb;
    public $headers = [];

    function __construct(string $path, string $verb)
    {
        $this->path = $path;
        $this->verb = $verb;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function setBody($body)
    {
        if (is_string($body) || is_array($body)) {
            $this->body = $body;
        }
    }

    public function setVerb(string $verb)
    {
        $this->verb = $verb;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}
