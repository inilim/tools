<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @template T of mixed
 * @param callable():T $callable
 * @return array{result:T,time:int,memory:int}
 */
function timedMsCall(callable $callable): array
{
    $m = \memory_get_usage(true);
    $ms = \Inilim\Tool\Method\Time\unixMs();
    $result = $callable();
    $ms = \Inilim\Tool\Method\Time\unixMs() - $ms;
    $m = \memory_get_usage(true) - $m;

    return [
        'result' => $result,
        'time'   => $ms,
        'memory' => $m,
    ];
}
