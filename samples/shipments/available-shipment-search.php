<?php

require_once __DIR__ . '/../config/bootstrap.php';

use CHRobinson\Shipments\AvailableShipmentSearch;
use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$request = new AvailableShipmentSearch;

// Minimum requirements
$request->body = [
    'dotNumber' => getenv('DOT_TRUCKLOADS'),
    'origin' => [
        'lat' => 25.7745,
        'lon' => -80.1709
    ],
    'originRadiusInMiles' => 10,
    'destination' => [
        'lat' => 25.8471,
        'lon' => -80.32872
    ]
];

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
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
