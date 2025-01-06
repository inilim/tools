<?php

namespace Inilim\Method\Other;

/**
 * @template T of bool
 * @psalm-type Trace = (T is true ? array : string)
 * @psalm-return array{message:string,line:int,code:int,file:string,trace:Trace,class:class-string}
 * @param T $traceAsArray
 */
function getExceptionDetails(\Throwable $e, bool $traceAsArray = false)
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
