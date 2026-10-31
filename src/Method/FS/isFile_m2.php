<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * 
 * @template T of string
 * @param T|T[] $filenames
 * @return array<T,bool>
 */
function isFile_m2($filenames): array
{
    \is_string($filenames) && $filenames = [$filenames];
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use (&$filenames) {
        $results = [];
        foreach ($filenames as $filename) {
            \clearstatcache(false, $filename);
            $t = \is_file($filename);
            $results[$filename] = null === $t ? false : $t;
        }
        return $results;
    });
    return \is_array($value) ? $value : [];
}
