<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @param callable(int $curIteration,int $maxIterations):bool $condition
 * @param callable(int $curIteration,int $maxIterations) $onBreak
 * @return void
 */
function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null)
{
    if ($maxIterations < 1) {
        if ($onBreak) {
            \call_user_func($onBreak, 0, $maxIterations);
        }
        return;
    }

    $curIteration = 0;
    while (true) {
        if (\call_user_func($condition, $curIteration, $maxIterations) === false) {
            break;
        }

        $curIteration++;

        if ($curIteration >= $maxIterations) {
            $curIteration--;
            break;
        }
    }

    if ($onBreak) {
        \call_user_func($onBreak, $curIteration, $maxIterations);
    }
}
