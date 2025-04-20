<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @todo tests
 * @author inilim
 * @return \RecursiveIteratorIterator<string,\SplFileInfo>
 * @throws \InvalidArgumentException
 */
function iteratorFilesRecursive(string $pathToDir, bool $skipDots = true)
{
    $dir = \realpath($pathToDir);
    if ($dir === false || !\is_dir($dir)) {
        throw new \InvalidArgumentException(\sprintf('Not found dir "%s"', $pathToDir));
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $dir = \Inilim\Tool\Method\Path\normalizePath($dir);

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $flags = \FilesystemIterator::KEY_AS_FILENAME | \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::UNIX_PATHS;
    if ($skipDots) {
        $flags |= \FilesystemIterator::SKIP_DOTS;
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $rdi = new \RecursiveDirectoryIterator(
        $dir,
        $flags
    );

    return new \RecursiveIteratorIterator(
        $rdi,
        \RecursiveIteratorIterator::SELF_FIRST
    );
}
