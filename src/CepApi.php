<?php
declare(strict_types=1);

namespace Ygreis\CepApiPhp;

use GuzzleHttp\Promise\AggregateException;
use Ygreis\CepApiPhp\Providers\BrasilApi;
use Ygreis\CepApiPhp\Providers\Correios;
use Ygreis\CepApiPhp\Providers\CorreiosOld;
use Ygreis\CepApiPhp\Providers\ViaCep;
use Ygreis\CepApiPhp\Providers\Widenet;

class CepApi
{

    public static function getAddress($cep)
    {

        try {
            $apis = \GuzzleHttp\Promise\Utils::any([
                BrasilApi::getAddress($cep),
                ViaCep::getAddress($cep),
                Correios::getAddress($cep),
                //CorreiosOld::getAddress($cep), // Disabled
                //Widenet::getAddress($cep), // Disabled
            ]);

            return [
                'success' => true,
                'errorMessage' => null,
                'data' => $apis->wait(),
            ];
        } catch (AggregateException $exception) {
            $reason = count($exception->getReason()) ? $exception->getReason()[0] : null;

            return [
                'success' => false,
                'errorMessage' => $reason ? $reason->getResponse()->getReasonPhrase() : $exception->getMessage(),
                'data' => [],
            ];
        }

    }

}

