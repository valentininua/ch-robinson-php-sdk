<?php

namespace CHRobinson\Shipments;

use CHRobinson\Http\HttpRequest;

class LoadBook extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v1/shipments/{loadNumber}/books?', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
