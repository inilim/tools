<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * 
 * @template T as string
 * @param T[] $filenames
 * @return array<T,bool>
 */
function unlink_m2(array $filenames): array
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use (&$filenames) {
        $results = [];
        foreach ($filenames as $f) {
            if (\unlink($f)) {
                \clearstatcache(false, $f);
                $results[$f] = true;
            } else {
                $results[$f] = false;
            }
        }

        return $results;
    });
    return null === $value ? [] : $value;
}
