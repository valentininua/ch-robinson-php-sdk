<?php

namespace CHRobinson\Http\Serializer;

use CHRobinson\Http\HttpRequest;
use CHRobinson\Http\Serializer;

/**
 * Class Json
 * @package CHRobinson\Http\Serializer
 *
 * Serializer for JSON content types.
 */
class Json implements Serializer
{

    public function contentType()
    {
        return "/^application\\/json/";
    }

    public function encode(HttpRequest $request)
    {
        $body = $request->body;
        if (is_string($body)) {
            return $body;
        }
        if (is_array($body)) {
            return json_encode($body);
        }
        throw new \Exception("Cannot serialize data. Unknown type");
    }

    public function decode($data)
    {
        return json_decode($data);
    }
}
