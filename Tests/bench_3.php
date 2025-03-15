<?php

use Inilim\Dump\Dump;
use Inilim\Tool\Str;

require_once __DIR__ . '/../vendor/autoload.php';

Dump::init();


$e = new \Exception('ttt', 100);


$start = \microtime(true);
for ($i = 0; $i <= 10000; $i++) {

    // de($a);
}
$finish = \microtime(true) - $start;

de($finish);
