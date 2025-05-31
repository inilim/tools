<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template T of \Throwable
 * @param T $e
 * @return array{message:string,line:int,code:int|string,file:string,trace:($traceAsArray is true ? mixed[] : string),class:class-string<T>}
 */
function getExceptionDetails(\Throwable $e, bool $traceAsArray = false): array
{
    return [
        'message' => $e->getMessage(),
        'line'    => $e->getLine(),
        'code'    => $e->getCode(),
        'file'    => $e->getFile(),
        'trace'   => $traceAsArray ? $e->getTrace() : $e->getTraceAsString(),
        'class'   => \get_class($e),
    ];
}
