<?php

namespace Inilim\Tool\Method\FS;

use Inilim\Dump\Dump;

require_once __DIR__ . '/../../../vendor/autoload.php';

Dump::init();

/**
 * @return ?\RecursiveIteratorIterator<string,\SplFileInfo>
 */
function getRecursiveIteratorFilesAsObj(string $dir, bool $skipDots = true)
{
    $dir = \realpath($dir);
    if ($dir === false || !\is_dir($dir)) {
        return null;
    }

    $dir = \Inilim\Tool\Method\Path\normalizePath($dir);

    $flags = \FilesystemIterator::KEY_AS_FILENAME | \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::UNIX_PATHS;
    if ($skipDots) {
        $flags |= \FilesystemIterator::SKIP_DOTS;
    }

    $rdi = new \RecursiveDirectoryIterator(
        $dir,
        $flags
    );

    $rii = new \RecursiveIteratorIterator(
        $rdi,
        \RecursiveIteratorIterator::SELF_FIRST
    );

    return $rii;
}


// $a = getIteratorByDir('dawd');

// print_r(realpath('../../../../tools'));
// exit;
// $flags = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS;
$flags = \FilesystemIterator::KEY_AS_FILENAME | \FilesystemIterator::CURRENT_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;
// $flags = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO;


$directoryIterator = new \RecursiveDirectoryIterator(
    \realpath('../../../../tools/vendor/inilim'),
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
    d([
        // '$key' => $key,
        // 'class' => get_class($value),
        '$value' => $value,
    ]);
    // exit;
}

de($i);
