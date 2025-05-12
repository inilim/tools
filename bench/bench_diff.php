<?php

use Inilim\Tool\Arr;
use Inilim\Tool\Str;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';
require_once __DIR__ . '/ArrClassic.php';

$prePeakMem       = \memory_get_peak_usage(false);
$preMem           = \memory_get_usage(false);
$preCountIncludes = \sizeof(\get_included_files());
$preNanoTime      = \hrtime(true);
$preMicroTime     = \microtime(true);

// ---------------------------------------------
// 
// ---------------------------------------------



$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];

// Arr::accessible($a);
// Arr::get($a, 4);
// Arr::add($a, 'key', ['VALUE']);
// ArrClassic::accessible($a);
// ArrClassic::get($a, 4);
// ArrClassic::add($a, 'key', ['VALUE']);


echo \json_encode([
    'prePeakMem'        => $prePeakMem,
    'preMem'            => $preMem,
    'preNanoTime'       => $preNanoTime,
    'preCountIncludes'  => $preCountIncludes,
    'preMicroTime'      => $preMicroTime,
    'postCountIncludes' => \sizeof(\get_included_files()),
    'postMem'           => \memory_get_usage(true),
    'postPeakMem'       => \memory_get_peak_usage(true),
    'postNanoTime'      => \hrtime(true),
    'postMicroTime'     => \microtime(true),
]);

// ---------------------------------------------
// 
// ---------------------------------------------