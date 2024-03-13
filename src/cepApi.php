<?php

class CepApi
{

    public static function getAddress($cep)
    {
        $apis = \GuzzleHttp\Promise\Utils::any([
            BrasilApi::getAddress($cep)
        ]);

        $data = $apis->wait();

        var_dump($data);
    }

}

