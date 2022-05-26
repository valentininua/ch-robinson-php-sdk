<?php

namespace CHRobinson\Core;

class ProductionEnvironment extends CHRobinsonEnvironment
{
    public function __construct($clientId, $clientSecret)
    {
        parent::__construct($clientId, $clientSecret);
    }

    public function baseUrl(): string
    {
        return "https://api.navisphere.com";
    }
}
