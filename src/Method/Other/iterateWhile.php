<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @param callable(int $curIteration,int $maxIterations):bool $condition
 * @param callable(int $curIteration,int $maxIterations) $onBreak
 */
function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null): void
{
    if ($maxIterations < 1) {
        if ($onBreak) {
            $onBreak(0, $maxIterations);
        }
        return;
    }

    $curIteration = 0;
    while (true) {
        if ($condition($curIteration, $maxIterations) === false) {
            break;
        }

        $curIteration++;

        if ($curIteration >= $maxIterations) {
            $curIteration--;
            break;
        }
    }

    if ($onBreak) {
        $onBreak($curIteration, $maxIterations);
    }
}
