<?php

use Inilim\Tool\VD;
use Inilim\Tool\Other;
use Symfony\Component\Process\Process;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\__include([
    // 
]);


$result = Other::timedMsCall(static function () {

    $phpFile = __DIR__ . '/subprocess.php';
    echo 'start' . PHP_EOL;
    // $process = new Process(['php', $phpFile]);
    // $process->run(); // 410ms
    // \exec('php ' . $phpFile); // 260ms
    // \shell_exec('php ' . $phpFile); // 250ms 
    // \passthru('php ' . $phpFile); // 250ms 
    // \system('php ' . $phpFile); // 250ms 
    echo 'end' . PHP_EOL;
});

VD::de($result);
