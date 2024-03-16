<?php

declare(strict_types=1);

namespace Ygreis\CepApiPhp\Providers;

use GuzzleHttp\Promise\Promise;

class Widenet
{
    public static function getAddress(string $cep)
    {
        $promise = new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'GET',
                "https://cdn.apicep.com/file/apicep/$cep.json", [
                'mode' => 'cors',
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            $promise->resolve(json_decode($response->getBody()->getContents(), true));
        });

        return $promise;
    }
}
