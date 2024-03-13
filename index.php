<?php

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';
/*require __DIR__.'/src/CepApi.php';
require __DIR__.'/src/Providers/BrasilApi.php';*/


Ygreis\CepApiPhp\CepApi::getAddress('01501-040');