<?php

use DragonCode\Benchmark\Benchmark;
use Inilim\Dump\Dump;

require_once __DIR__ . '/../vendor/autoload.php';

Dump::init();
$find = 'T11Mq6nvvqRSUbP';
$namespace = 'Inilim\Tool\Method\Str';


// $array = include  __DIR__ . '/array_list.php';
$array = include  __DIR__ . '/array_keys.php';
// $str = ',' . \implode(',', $array[$namespace]) . ',';


$start = \microtime(true);
for ($i = 0; $i <= 10000; $i++) {

    // $a = \str_contains($str, ',' . $find . ',');
    // $a = \strpos($str, ',' . $find . ',') !== false;
    // $a = \in_array($find, $array[$namespace]);
    // $a = isset($array[$namespace][$find]);
    // $a = \array_key_exists($find, $array[$namespace]);
    // $a = \array_search($find, $array);
}
$finish = \microtime(true) - $start;

de($finish);

// Benchmark::start()
//     ->withoutData()
//     ->iterations(200)
//     ->round(3)
//     ->compare([
//         'in_array' => static function () use ($find, $array) {
//             \in_array($find, $array);
//         },
//         'array_search' => static function () use ($find, $array) {
//             \array_search($find, $array);
//         },
//     ]);
