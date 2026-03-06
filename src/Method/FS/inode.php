<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * @link https://php.net/manual/en/function.fileinode.php
 * 
 * Gets file inode
 */
function inode(string $filename): ?int
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($filename) {
        \clearstatcache(false, $filename);
        return \fileinode($filename);
    });
    return $value === false ? null : $value;
}
