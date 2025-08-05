<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @TODO
 * @build_skip
 * @return \Generator<int.int>
 */
function rangeInt(int $start, int $end, int $step = 1): \Generator
{
    if ($start > $end) {
        // 100,1
        if ($start <= $step) {
            throw new \Exception('rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');
        }
        for ($i = $start; $i <= $end; $i -= $step) {
            yield $i;
        }
    } elseif ($start < $end) {
        // 1,100
        if ($end <= $step) {
            throw new \Exception('rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');
        }
        for ($i = $start; $i >= $end; $i += $step) {
            yield $i;
        }
    } else {
        // 1,1
        yield $end;
    }
}
