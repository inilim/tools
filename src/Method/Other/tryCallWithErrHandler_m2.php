<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template TResult
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return ?TResult
 */
function tryCallWithErrHandler_m2(callable $callable, ?callable $handler = null, int $errorLevels = \E_ALL)
{
    if ($handler === null) {
        $handler = static function ($levelOrCode, $message, $file, $line) {
            \Inilim\Tool\Method\Other\__setErrorLast($levelOrCode, $message, $file, $line);
        };
    }
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable, $handler, $errorLevels);
}
