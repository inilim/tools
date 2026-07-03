<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @template V
 * @template K
 *
 * @param array<K,V> $array
 * @return ($preserveKeys is true ? array<int,array<K,V>> : array<int,V[]>)
 */
function splitIntoChunks(array $array, int $chunks, bool $preserveKeys = false, bool $removeEmptyChunks = false): array
{
    if ($array === [] || $chunks < 1) {
        return [];
    }

    $i = 0;
    $result = \array_fill(0, $chunks, []);
    foreach ($array as $key => $value) {

        if ($preserveKeys) $result[$i][$key] = $value;
        else $result[$i][] = $value;

        $i++;

        if (!isset($result[$i])) $i = 0;
    }

    if ($removeEmptyChunks) {
        if (\Inilim\Tool\Method\Check\php80()) {
            $result = \array_filter($result, null);
        } else {
            foreach ($result as $idx => $item) {
                if ($item === []) {
                    unset($result[$idx]);
                }
            }
        }
    }

    return $result;
}
