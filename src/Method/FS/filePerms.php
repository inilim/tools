<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @link https://php.net/manual/en/function.fileperms.php
 */
function filePerms(string $filename): ?int
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \fileperms($filename), null);
    /** @var int|false $value */
    return $value === false ? null : $value;
}
