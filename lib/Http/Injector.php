<?php

namespace CHRobinson\Http;

interface Injector
{
    public function inject($httpRequest);
}
