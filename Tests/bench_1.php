<?php

use Inilim\Tool\Arr;
use Inilim\Tool\Str;

require_once __DIR__ . '/../vendor/autoload.php';

$preMem           = \memory_get_usage(true);
$preCountIncludes = \sizeof(\get_included_files());
$preNanoTime      = \hrtime(true);

// ---------------------------------------------
// 
// ---------------------------------------------

$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];
Arr::accessible($a);
Arr::get($a, 4);
Arr::add($a, 'key', ['VALUE']);
Arr::compareValues($a, $a);
Str::nl2space('1


2');

// ---------------------------------------------
// 
// ---------------------------------------------

echo \json_encode([
    'preMem'            => $preMem,
    'preNanoTime'       => $preNanoTime,
    'preCountIncludes'  => $preCountIncludes,
    'postCountIncludes' => \sizeof(\get_included_files()),
    'postMem'           => \memory_get_usage(true),
    'postNanoTime'      => \hrtime(true),
]);
