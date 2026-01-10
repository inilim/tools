<?php

use Inilim\Tool\FS;
use Inilim\Tool\Path;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

$file = $argv[1] ?? '';

$root = Path::realPath(__DIR__ . '/../');

$bin = $root . '/vendor/bin/phpunit';
$bin = Path::normalize($bin);

if (!FS::isFile($bin)) {
    echo \sprintf('File not found "%s"', $bin);
    exit;
}

if ($file) {
    $file = $root . '/' . $file;
    $file = Path::normalize($file);

    if (!FS::isFile($file)) {
        echo \sprintf('File test not found "%s"', $file);
        exit;
    }
    $process = new Process(['php74', $bin, $file]);
} else {
    $process = new Process(['php74', $bin]);
}

$process->setTimeout((float) 999_999);
// $file = Path::realPath($file);
$process->run();
$output = $process->getOutput();

$fileOutput = $root . '/files/phpunit-output.txt';
\file_put_contents($fileOutput, $output);

echo $output . PHP_EOL . 'File output last: ' . $fileOutput;
