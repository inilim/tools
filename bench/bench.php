<?php

require_once \dirname(__DIR__) . '/bootstrap.dev.php';
require_once __DIR__ . '/ArrClassic.php';

// $pathToPhp = __DIR__ . '/bench_1.php';
$pathToPhp = __DIR__ . '/bench_diff.php';
$results = [];

// Прогрев
\exec('php ' . $pathToPhp);
\exec('php ' . $pathToPhp);

for ($i = 0; $i < 25; $i++) {
    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $output = [];
    \exec('php ' . $pathToPhp, $output);
    // $process->run();
    // $output = \json_decode(\trim($process->getOutput()), true);
    $output = \json_decode(\trim($output[0]), true);

    $output['finalTime']           = $output['postNanoTime']      - $output['preNanoTime'];
    $output['finalMicroTime']      = $output['postMicroTime']     - $output['preMicroTime'];
    $output['finalMem']            = $output['postMem']           - $output['preMem'];
    $output['finalPeakMem']        = $output['postPeakMem']       - $output['prePeakMem'];
    $results[] = $output;

    // ---------------------------------------------
    // 
    // ---------------------------------------------
}

$colsT  = \array_column($results, 'finalTime');
$colsMT = \array_column($results, 'finalMicroTime');
$colsM  = \array_column($results, 'finalMem');
$colsPM = \array_column($results, 'finalPeakMem');

de([
    '$pathToPhp' => $pathToPhp,
    // '$results'       => $results,
    // 'finalTimeCols'  => $colsT,
    'finalTimeAvg'         => \array_sum($colsT) / \sizeof($colsT),
    'finalMicroTimeAvg'    => \array_sum($colsMT) / \sizeof($colsMT),
    // 'finalMemCols'   => $colsM,
    'finalMemAvg'       => @\array_sum($colsM) / \sizeof($colsM),
    'finalPeakMemAvg'   => @\array_sum($colsPM) / \sizeof($colsPM),
]);
