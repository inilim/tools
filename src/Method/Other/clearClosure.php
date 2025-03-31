<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template T of \Closure
 * @param T $cls
 * @return T
 */
function clearClosure(\Closure $cls)
{
    return $cls->bindTo(null, null);
}
