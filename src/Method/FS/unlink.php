<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * @param ?resource $context
 */
function unlink(string $filename, $context = null): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($filename, $context) {
        $result = $context ? \unlink($filename, $context) : \unlink($filename);
        if ($result) {
            \clearstatcache(false, $filename);
            return true;
        }
        return false;
    });
    return $value === null ? false : $value;
}
