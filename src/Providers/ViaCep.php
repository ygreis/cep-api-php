<?php

declare(strict_types=1);

namespace Ygreis\CepApiPhp\Providers;

use GuzzleHttp\Promise\Promise;

class ViaCep
{
    public static function getAddress(string $cep)
    {
        $promise = new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'GET',
                "https://viacep.com.br/ws/$cep/json/", [
                'mode' => 'cors',
                'headers' => [
                    'Accept' => 'application/json;charset=utf-8',
                ]
            ]);

            $promise->resolve(json_decode($response->getBody()->getContents(), true));
        });

        return $promise;
    }
}
