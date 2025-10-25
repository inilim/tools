<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * @see https://www.php.net/manual/ru/function.stat.php
 * @return null|array{dev: int, ino: int, mode: int, nlink: int, uid: int, gid: int, rdev: int, size: int, atime: int, mtime: int, ctime: int, blksize: int, blocks: int}
 */
function stat(string $filename): ?array
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($filename) {
        \clearstatcache(false, $filename);
        return \stat($filename);
    });
    return \is_bool($value) ? null : $value;
}
