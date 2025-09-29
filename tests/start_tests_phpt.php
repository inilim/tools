<?php

use Inilim\Dump\Dump;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

Dump::init();

// ---------------------------------------------
// Проверить наличие исполняемого php бинаря
// ---------------------------------------------



// ---------------------------------------------
// 
// ---------------------------------------------

$finder = new Finder;
$finder->in(__DIR__ . '/phpt')
    ->files()
    ->name('case*')
    // 
;

foreach ($finder as $case) {
    $case = $case->getPathname();
    de($case);
    $process = new Process(['', '']);
}
