<?php

namespace CHRobinson\Shipments;

use CHRobinson\Http\HttpRequest;

class MilestoneUpdates extends HttpRequest
{
    public function __construct()
    {
        parent::__construct('/v1/shipments/milestones?', 'POST');
        $this->headers['Content-Type'] = 'application/json';
    }
}
