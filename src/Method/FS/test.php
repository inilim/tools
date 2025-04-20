<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

require_once __DIR__ . '/../../../vendor/autoload.php';


// @skip_build
// $a = getIteratorByDir('dawd');

// print_r(realpath('../../../../tools'));
// exit;
$flags = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;
// $flags = \FilesystemIterator::KEY_AS_FILENAME | \FilesystemIterator::CURRENT_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;
// $flags = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO;


$directoryIterator = new \RecursiveDirectoryIterator(
    \strtr(\realpath('../../../../tools/vendor/inilim'), '\\', '/'),
    // 'D:\projects\tools',
    $flags
);

$iteratorIterator = new \RecursiveIteratorIterator(
    $directoryIterator,
    \RecursiveIteratorIterator::SELF_FIRST
);

$i = 0;
foreach ($iteratorIterator as $key => $value) {
    $i++;
    \de([
        '$key' => $key,
        // 'class' => get_class($value),
        '$value' => $value,
    ]);
    // exit;
}

de($i);
