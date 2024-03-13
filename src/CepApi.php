<?php
declare(strict_types=1);

namespace Ygreis\CepApiPhp;

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

