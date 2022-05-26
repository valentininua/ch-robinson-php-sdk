<?php

namespace CHRobinson\Shipments;

use CHRobinson\Http\HttpRequest;

class AvailableShipmentSearch extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v2/shipments/available/searches?', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
