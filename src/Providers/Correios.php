<?php

declare(strict_types=1);

namespace Ygreis\CepApiPhp\Providers;

use GuzzleHttp\Promise\Promise;

class Correios
{
    public static function getAddress(string $cep)
    {
        $promise = new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'POST',
                "https://buscacepinter.correios.com.br/app/endereco/carrega-cep-endereco.php", [
                'body' => "endereco=$cep&tipoCEP=ALL",
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Referer' => 'https://buscacepinter.correios.com.br/app/endereco/index.php',
                    'Referrer-Policy' => 'strict-origin-when-cross-origin'
                ]
            ]);

            $promise->resolve(json_decode($response->getBody()->getContents(), true));
        });

        return $promise;
    }
}
