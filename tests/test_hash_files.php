<?php

declare(strict_types=1);

use Inilim\Tool\Path;
use Symfony\Component\Finder\Finder;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

// ---------------------------------------------
// 
// ---------------------------------------------

$finder = new Finder;
$finder->in(__DIR__ . '/files/json/token_calc')->files()->name('*.json');

// ---------------------------------------------
// 
// ---------------------------------------------

foreach ($finder as $ptf => $_) {
    $ptf = \realpath($ptf);
    $ptf = Path::normalize($ptf);
    dd([
        'file' => $ptf,
        'md5' => \hash_file('md5', $ptf),
        'sha1' => \hash_file('sha1', $ptf),
        'sha256' => \hash_file('sha256', $ptf),
    ]);
}
