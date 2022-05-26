<?php

require_once __DIR__ . '/../config/bootstrap.php';

use CHRobinson\Shipments\MilestoneUpdates;
use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;
use CHRobinson\Core\ProductionEnvironment;
use CHRobinson\Http\HttpException;

$request = new MilestoneUpdates;
$request->body = [
    'eventCode' => 'X6',
    'shipmentIdentifier' => [
        'shipmentNumber' => '123456789'
    ],
    'dateTime' => [
        'eventDateTime' => '2019-12-19T18:36:13.131Z'
    ],
    'location' => [
        'type' => 'drop',
        'address' => [
            'address1' => '1015 North America Way',
            'city' => 'Miami',
            'stateProvinceCode' => 'FL',
            'country' => 'US',
            'latitude' => '25.7788029',
            'longitude' => '-80.1779935'
        ]
    ]
];

$client = (bool) getenv('DEV_MODE') ?
    new CHRobinsonHttpClient(new SandboxEnvironment(
        getenv('SANDBOX_CLIENT_ID'),
        getenv('SANDBOX_CLIENT_SECRET')
    )) :
    new CHRobinsonHttpClient(new ProductionEnvironment(
        getenv('CLIENT_ID'),
        getenv('CLIENT_SECRET')
    ));

try {
    $response = $client->execute($request);
} catch(\Exception $e) {
    dump([
        'statusCode' => $e->getStatusCode(),
        'message' => $e->getMessage()
    ]);
    die();
}

if ($response->getStatusCode() == 201) {
    echo 'Success';
}
