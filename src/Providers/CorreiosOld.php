<?php

declare(strict_types=1);

namespace Ygreis\CepApiPhp\Providers;

use GuzzleHttp\Promise\Promise;

class CorreiosOld
{
    public static function getAddress(string $cep)
    {
        $promise = new Promise(function() use(&$promise, $cep){
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'POST',
                "https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente",
                [
                    'body' => '<?xml version="1.0"?>\n<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cli="http://cliente.bean.master.sigep.bsb.correios.com.br/">\n  <soapenv:Header />\n  <soapenv:Body>\n    <cli:consultaCEP>\n      <cep>${cepWithLeftPad}</cep>\n    </cli:consultaCEP>\n  </soapenv:Body>\n</soapenv:Envelope>',
                    'headers' => [
                        'Content-Type' => 'text/xml;charset=UTF-8',
                        'cache-control' => 'no-cache'
                    ]
            ]);

            $promise->resolve(json_decode($response->getBody()->getContents(), true));
        });

        return $promise;
    }
}
