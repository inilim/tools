<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template T of \Closure
 * @param T $cls
 * @return ?T
 */
function clearClosure(\Closure $cls): ?\Closure
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => $cls->bindTo(null, null));
}
