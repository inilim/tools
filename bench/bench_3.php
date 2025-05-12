<?php

use Inilim\Tool\Data;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

__include('Data::URLProtocolsAsString');
__include('Data::URLProtocolsAsGenerator');
__include('Data::URLProtocolsAsClosure');
__include('Str::replaceFirst');

// $a = \Inilim\Tool\Method\Data\URLProtocolsAsString('|');

// de($a);

$start = \microtime(true);
for ($i = 0; $i <= 10000; $i++) {
    // \Inilim\Tool\Method\Data\URLProtocolsAsStringV2('|');
    \Inilim\Tool\Method\Data\URLProtocolsAsString('|');
}
$finish = \microtime(true) - $start;

de($finish);
