<?php
use GuzzleHttp\Promise\Promise;

class BrasilApi
{
    public static function getAddress(string $cep)
    {
        return new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'GET',
                "https://brasilapi.com.br/api/cep/v1/$cep", [
                'headers' => [
                    'Accept' => 'application/json;charset=utf-8',
                ]
            ]);
            return $response->getBody();
        });
    }
}