<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Generate a sequence of numbers as a generator, similar to PHP's native range() but memory-efficient.
 * Works like \range() but returns a Generator instead of an array.
 * 
 * @param int|float $start First value of the sequence
 * @param int|float $end The sequence is ended upon reaching the end value
 * @param int|float $step If a step value is given, it will be used as the increment between elements in the sequence
 * @return \Generator<int, int|float>
 */
function range($start, $end, $step = 1) {
    // Validate step to avoid infinite loops
    if ($step == 0) {
        throw new \InvalidArgumentException('Step cannot be zero');
    }

    // Determine if we're counting up or down
    $isUp = ($step > 0 && $start <= $end) || ($step < 0 && $start >= $end);

    if ($isUp) {
        // Counting up
        $current = $start;
        if ($step > 0) {
            while ($current <= $end) {
                yield $current;
                $current += $step;
            }
        } else {
            // Negative step but going up (start <= end)
            while ($current >= $end) {
                yield $current;
                $current += $step;
            }
        }
    } else {
        // Counting down
        $current = $start;
        if ($step > 0) {
            // Positive step but going down (start > end)
            while ($current >= $end) {
                yield $current;
                $current += $step;
            }
        } else {
            // Negative step and going down
            while ($current >= $end) {
                yield $current;
                $current += $step;
            }
        }
    }
}