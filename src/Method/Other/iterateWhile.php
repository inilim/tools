<?php

namespace Inilim\Tool\Method\Other;

/**
 * @param callable(int,int):bool $condition
 * @param callable(int,int) $onBreak
 * @return void
 */
function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null)
{
    if ($maxIterations < 1) return;

    $curIteration = 0;
    while (true) {
        if (\call_user_func($condition, $curIteration, $maxIterations) === false) {
            return;
        }

        $curIteration++;

        if ($curIteration >= $maxIterations) {
            break;
        }
    }

    if ($onBreak) \call_user_func($onBreak, $curIteration, $maxIterations);
}
