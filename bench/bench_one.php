<?php

use Inilim\Tool\Arr;
use Inilim\Tool\Refl;
use Inilim\Tool\LazyMethodAbstract;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';
require_once __DIR__ . '/ArrClassic.php';

// Прогрев
$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];

$a = Arr::__asClosure('get', 'add');
[$get, $add] = Arr::__asClosure('get', 'add');

de($a);
// 

$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];

$start = \microtime(true);
for ($i = 0; $i <= 10_000; $i++) {

    // $get($a, 4);
    // $add($a, 'key', ['VALUE']);

    // Arr::get($a, 4);
    // Arr::add($a, 'key', ['VALUE']);


    // \ArrClassic::get($a, 4);
    // \ArrClassic::add($a, 'key', ['VALUE']);
}
$finish = \microtime(true) - $start;

$prop = Refl::getProp(LazyMethodAbstract::class, 'exists');

de([
    '$prop' => $prop->getValue(),
    '$finish' => $finish,
    'count'   => \sizeof(\get_included_files()),
]);
