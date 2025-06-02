<?php

use Inilim\Tool\Arr;

require_once \dirname(__DIR__) . '/src/LazyMethodAbstract.php';
require_once \dirname(__DIR__) . '/src/Arr.php';


$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];

$start = \microtime(true);
for ($i = 0; $i <= 10_000; $i++) {

    Arr::get($a, 4);
    // Arr::add($a, 'key', ['VALUE']);
    // Arr::compareValues($a, $a);


    // \ArrClassic::get($a, 4);
    // \ArrClassic::add($a, 'key', ['VALUE']);
    // \ArrClassic::compareValues($a, $a);
}

echo \microtime(true) - $start;
