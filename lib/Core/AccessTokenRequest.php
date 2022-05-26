<?php

namespace CHRobinson\Core;

use CHRobinson\Http\HttpRequest;

class AccessTokenRequest extends HttpRequest
{
    public function __construct(CHRobinsonEnvironment $environment)
    {
        parent::__construct('/v1/oauth/token', 'POST');
        $body = [
            'grant_type' => 'client_credentials',
            'audience' => 'https://inavisphere.chrobinson.com',
            'client_id' => $environment->getClientId(),
            'client_secret' => $environment->getClientSecret()
        ];
        $this->body = $body;
        $this->headers['Content-Type'] = 'application/json';
    }
}
