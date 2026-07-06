<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 * 
 * @return \Generator<int,int>
 * @throws \ErrorException
 */
function rangeInt(int $start, int $end, int $step = 1): \Generator
{
    if ($step === 0) {
        throw new \ErrorException(\Inilim\Tool\Obj::class . '::rangeInt(): Argument #3 ($step) cannot be 0');
    }

    if ($start > $end) {
        // 100,1
        $range = $start - $end;
        if ($step > $range) {
            throw new \ErrorException(\Inilim\Tool\Obj::class . '::rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');
        }
        for ($i = $start; $i >= $end; $i -= $step) {
            yield $i;
        }
    } elseif ($end > $start) {
        // 1,100
        $range = $end - $start;
        if ($step > $range) {
            throw new \ErrorException(\Inilim\Tool\Obj::class . '::rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');
        }
        for ($i = $start; $i <= $end; $i += $step) {
            yield $i;
        }
    } else {
        // 1,1
        yield $end;
    }
}
