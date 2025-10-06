<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @skip_build
 * 
 * @author inilim
 * @todo tests
 * 
 * @template R
 * @template A of mixed[]|mixed
 * @template E of \Throwable
 * 
 * @param callable(A ...$args):R $callable
 * @param A $args
 * @param class-string<E> $class
 * @return R
 */
function callThrowIfExistError(callable $callable, $args = [], string $class = \Error::class)
{
    $beforeErr = \Inilim\Tool\Method\Other\errorGetLast();
    \Inilim\Tool\Method\Other\errorClearLast();
    if (!\is_array($args)) {
        $args = [$args];
    }
    $result = $callable(...$args);
    $afterErr = \Inilim\Tool\Method\Other\errorGetLast();
    if ($beforeErr) {
        \Inilim\Tool\Method\Other\__setErrorLast(
            $beforeErr['type'],
            $beforeErr['message'],
            $beforeErr['file'],
            $beforeErr['line']
        );
    }
    if ($afterErr) {
        throw \Inilim\Tool\Method\Obj\rewriteLocationException(
            new $class($afterErr['message']),
            $afterErr['file'],
            $afterErr['line']
        );
    }

    return $result;
}
