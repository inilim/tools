<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Dump\Dump;

Dump::init();

$results = [];

for ($i = 0; $i < 25; $i++) {
    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $pathToPhp = __DIR__ . '/bench_1.php';
    $output = [];
    \exec('php ' . $pathToPhp, $output);
    $output = \strval($output[0] ?? '');
    $output = \json_decode($output, true);

    $output['finalTime']           = $output['postNanoTime']      - $output['preNanoTime'];
    $output['finalMem']            = $output['postMem']           - $output['preMem'];
    $results[] = $output;

    // ---------------------------------------------
    // 
    // ---------------------------------------------
}

de([
    '$results'      => $results,
    'finalTimeCols' => $cols = \array_column($results, 'finalTime'),
    'finalTimeAvg'  => \array_sum($cols) / \sizeof($cols),
    'finalMemCols'  => $cols = \array_column($results, 'finalMem'),
    'finalMemAvg'   => @\array_sum($cols) / \sizeof($cols),
]);
