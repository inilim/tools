<?php

namespace Inilim\Method\Arr;

/**
 * @template T
 * @template K
 *
 * @param array<K,T> $array
 * @return array<int,array<K,T>>
 */
function splitIntoChunks(array $array, int $chunks, bool $preserve_keys = false, bool $remove_empty_chunks = false): array
{
    if (!$array || $chunks === 0) return [];
    // return \array_chunk($array, \ceil(\sizeof($array) / \abs($chunks)), $preserve_keys);

    $i = 0;
    $result = \array_fill(0, \abs($chunks), []);
    foreach ($array as $key => $value) {

        if ($preserve_keys) $result[$i][$key] = $value;
        else $result[$i][] = $value;

        $i++;

        if (!isset($result[$i])) $i = 0;
    }

    if ($remove_empty_chunks) {
        $result = \array_filter($result, null);
    }

    return $result;
}
