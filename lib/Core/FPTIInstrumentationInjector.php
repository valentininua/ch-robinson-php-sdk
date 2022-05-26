<?php

namespace CHRobinson\Core;

use CHRobinson\Http\Injector;

class FPTIInstrumentationInjector implements Injector
{
    public function inject($request)
    {
        $request->headers["sdk_name"] = "CH Robinson SDK empirenationa.com";
        $request->headers["sdk_version"] = "1.0.1";
        $request->headers["sdk_tech_stack"] = "PHP " . PHP_VERSION;
    }
}
