<?php

namespace Inilim\Tool\Method\Other;

/**
 * @template T of \Closure
 * @param T $cls
 * @return T
 */
function clearClosure(\Closure $cls)
{
    return $cls->bindTo(null, null);
}
