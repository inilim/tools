<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * 
 * @template R of mixed
 * @template Time of int
 * @template Memory of int
 * 
 * @param callable():R $callable
 * @return array{result:R,time:Time,memory:Memory,"...":array{R,Time,Memory}}
 */
function timedMsCall(callable $callable): array
{
    $m = \memory_get_usage(true);
    $ms = \Inilim\Tool\Method\Time\unixMs();
    $result = $callable();
    $ms = \Inilim\Tool\Method\Time\unixMs() - $ms;
    $m = \memory_get_usage(true) - $m;

    return \Inilim\Tool\Method\Other\_refDots([
        'result' => $result,
        'time'   => $ms,
        'memory' => $m,
    ]);
}
