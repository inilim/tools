<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @template T of mixed
 * @param callable():T $callable
 * @return array{result:T,time:int}
 */
function timedMsCall(callable $callable): array
{
    $ms = \Inilim\Tool\Method\Time\unixMs();
    $result = $callable();
    $ms = \Inilim\Tool\Method\Time\unixMs() - $ms;

    return [
        'result' => $result,
        'time'   => $ms,
    ];
}
