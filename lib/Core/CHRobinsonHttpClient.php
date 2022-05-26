<?php

namespace CHRobinson\Core;

use CHRobinson\Http\HttpClient;

class CHRobinsonHttpClient extends HttpClient
{
    private $refreshToken;
    public $authInjector;

    public function __construct(CHRobinsonEnvironment $environment, $refreshToken = NULL)
    {
        parent::__construct($environment);
        $this->refreshToken = $refreshToken;
        $this->authInjector = new AuthorizationInjector($this, $environment, $refreshToken);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
    }

    public function userAgent(): string
    {
        return UserAgent::getValue();
    }
}

