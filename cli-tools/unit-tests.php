<?php

use Inilim\Tool\FS;
use Inilim\Tool\Path;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

$file = $argv[1] ?? '';

$root = Path::realPath(__DIR__ . '/../');

if (!FS::isFile(Path::normalize($root . '/' . $file))) {
    echo \sprintf('File test not found "%s"', $file);
    exit;
}

// $file = Path::realPath($file);
$process = new Process(['php74', 'vendor/bin/phpunit', $file]);
$process->run();
echo $process->getOutput();
