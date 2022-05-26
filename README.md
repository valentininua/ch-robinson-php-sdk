# CH Robinson PHP SDK

This repository contains the C.H Robinson SDK and samples for the Shipments API. It includes a simplified interface to only provide simple model objects and blueprints for HTTP calls. Refer to the [C.H Robinson Developer](https://www.google.com) portal for more information.

## Prerequisites

PHP 7 and above

## Usage

### Install

```bash
composer require valentininua/ch-robinson-php-sdk
```

### Setting up credentials

Obtain your Sandbox Client ID and Client Secret from C.H Robinson.

```php

use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;

$client = new CHRobinsonHttpClient(new SandboxEnvironment(
    getenv('SANDBOX_CLIENT_ID'),
    getenv('SANDBOX_CLIENT_SECRET')
));

```

## Examples

### Sending a Milestone update with the Shipments API

```php

use CHRobinson\Shipments\MilestoneUpdates;

$request = new MilestoneUpdates;
$request->body = [
    'eventCode' => 'X6',
    'shipmentIdentifier' => [
        'shipmentNumber' => '123456789'
    ],
    'dateTime' => [
        'eventDateTime' => '2019-12-16T18:36:13.131Z'
    ],
    'location' => [
        'address' => [
            'address1' => 'address if known, or blank',
            'city' => 'state if known, or blank',
            'stateProvinceCode' => 'state if known, or blank',
            'country' => 'US',
            'latitude' => '31.717096',
            'longitude' => '-99.132553'
        ]
    ]
];

$response = $client->execute($request);

if ($response->getStatusCode() == 201) {
    echo 'Success';
}

```

###### **Example 2**


```php

namespace backend\controllers;

use CHRobinson\Core\CHRobinsonHttpClient;
use CHRobinson\Core\SandboxEnvironment;
use CHRobinson\Shipments\AvailableShipmentSearch;

class ChrobinsonController extends Controller
{

    /**
     * Lists all Agents models.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $SANDBOX_CLIENT_ID = '00000000000000000';
        $SANDBOX_CLIENT_SECRET = '000000000000000000000000000000000000000000000000000';

        $client = new CHRobinsonHttpClient(new SandboxEnvironment(
            $SANDBOX_CLIENT_ID,
            $SANDBOX_CLIENT_SECRET,
        ));

        $request = new AvailableShipmentSearch;
        $request->body = json_decode('{ "pageIndex": 0,  "pageSize": 100,  "regionCode": "NA",  "modes": [    "V",    "R"  ],  "originRadiusSearch": {    "coordinate": {      "lat": 37.775,      "lon": -122.41833    },    "radius": {      "value": 1000,      "unitOfMeasure": "Standard"    }  },  "destinationRadiusSearch": {    "coordinate": {      "lat": 37.775,      "lon": -122.41833    },    "radius": {      "value": 1000,      "unitOfMeasure": "Standard"    }  },  "loadDistanceRange": {    "unitOfMeasure": "Standard",    "min": 0,    "max": 5000  },  "loadWeightRange": {    "unitOfMeasure": "Standard",    "min": 0,    "max": 48000  },  "equipmentLengthRange": {    "unitOfMeasure": "Standard",    "min": 0,    "max": 53  },  "availableForPickUpByDateRange": {    "min": "2021-06-29",    "max": "2021-06-30"  },  "teamLoad": true,  "stfLoad": true,  "hazMatLoad": true,  "tankerLoad": true,  "chemicalSolutionLoad": true,  "highValueLoad": true,  "sortCriteria": {    "field": "LoadNumber",    "direction": "ascending"  }}', 1);

        $response = $client->execute($request);

        if (200 == $response->getStatusCode()) {
            echo 'Success';
        }

        dd($response);
    }


}
```
