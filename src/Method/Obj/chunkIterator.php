<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 * 
 * @template TValue
 * @template TKey
 *
 * @param iterable<TKey,TValue> $iterable
 * @param positive-int $size
 * @return ($preserve_keys is true ? \Generator<TKey,TValue> : \Generator<int,TValue>)
 */
function chunkIterator(iterable $iterable, int $size, bool $preserve_keys = true): \Generator
{
    \Inilim\Tool\Method\Assert\positiveInteger($size);

    $chunk = [];
    $count = 0;
    foreach ($iterable as $key => $value) {
        if ($preserve_keys) {
            $chunk[$key] = $value;
        } else {
            $chunk[] = $value;
        }
        $count++;

        if ($count >= $size) {
            yield $chunk;
            $count = 0;
            $chunk = [];
        }
    }

    if ($chunk !== []) {
        yield $chunk;
    }
}


// $a = ['daw' => 123];

// foreach (chunkIterator($a, 1, false) as $key => $item) {
//     // 
// }
