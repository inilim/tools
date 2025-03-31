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
 * @return array{result:C|D,exception:null|\Throwable}
 */
function tryCallCallable(callable $callable, array $args = [], $default = null)
{
    try {
        $result = \call_user_func_array($callable, $args);
    } catch (\Throwable $e) {
        return [
            'result'    => $default,
            'exception' => $e,
        ];
    }
    return [
        'result'    => $result,
        'exception' => null,
    ];
}
