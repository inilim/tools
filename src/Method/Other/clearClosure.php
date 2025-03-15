<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return \Closure
 */
function clearClosure(\Closure $cls)
{
    return $cls->bindTo(null, null);
}
