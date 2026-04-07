<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template C of mixed
 * @template D of mixed
 * @template A of mixed
 * 
 * @param callable(...A):C $callable
 * @param array<A> $args
 * @param D $default
 * @return array{result:C|D,exception:null|\Throwable,"...":array{C|D,null|\Throwable}}
 */
function tryCallCallable(callable $callable, array $args = [], $default = null): array
{
    try {
        $result = $callable(...$args);
    } catch (\Throwable $e) {
        return \Inilim\Tool\Method\Other\_refDots([
            'result'    => $default,
            'exception' => $e,
        ]);
    }
    return \Inilim\Tool\Method\Other\_refDots([
        'result'    => $result,
        'exception' => null,
    ]);
}
