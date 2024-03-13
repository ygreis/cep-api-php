<?php
use GuzzleHttp\Promise\Promise;

class BrasilApi
{
    public static function getAddress(string $cep)
    {
        $promise = new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'GET',
                "https://brasilapi.com.br/api/cep/v1/$cep", [
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