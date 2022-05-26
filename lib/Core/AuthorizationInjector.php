<?php

namespace CHRobinson\Core;

use CHRobinson\Http\HttpRequest;
use CHRobinson\Http\Injector;
use CHRobinson\Http\HttpClient;

class AuthorizationInjector implements Injector
{
    private $client;
    private $environment;
    private $refreshToken;
    public $accessToken;

    public function __construct(HttpClient $client, CHRobinsonEnvironment $environment, $refreshToken)
    {
        $this->client = $client;
        $this->environment = $environment;
        $this->refreshToken = $refreshToken;
    }

    public function inject($request)
    {
        if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request)) {
            if (is_null($this->accessToken) || $this->accessToken->isExpired()) {
                $this->accessToken = $this->fetchAccessToken();
            }
            $request->headers['Authorization'] = 'Bearer ' . $this->accessToken->token;
        }
    }

    private function fetchAccessToken()
    {
//        $accessTokenFile = './.production-access-token.json';
//
//        if (file_exists($accessTokenFile)) {
//            $accessToken = json_decode(file_get_contents($accessTokenFile));
//            $accessToken = new AccessToken(
//                $accessToken->access_token,
//                $accessToken->token_type,
//                $accessToken->expires_in,
//                $accessToken->create_time
//            );
//            if ($accessToken->isExpired()) {
//                unlink($accessTokenFile);
//            } else {
//                return $accessToken;
//            }
//        }

        $accessTokenResponse = $this->client->execute(new AccessTokenRequest($this->environment, $this->refreshToken));
        $accessToken = $accessTokenResponse->result;

//        $jsonData = [
//            'access_token' => $accessToken->access_token,
//            'token_type' => $accessToken->token_type,
//            'expires_in' => $accessToken->expires_in,
//            'create_time' => time()
//        ];
//        file_put_contents($accessTokenFile, json_encode($jsonData), LOCK_EX);

        return new AccessToken($accessToken->access_token, $accessToken->token_type, $accessToken->expires_in);
    }

    private function isAuthRequest($request)
    {
        return $request instanceof AccessTokenRequest;
    }

    private function hasAuthHeader(HttpRequest $request)
    {
        return array_key_exists("Authorization", $request->headers);
    }
}
