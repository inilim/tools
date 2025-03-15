<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return void
 */
function clearClosureRef(\Closure &$cls)
{
    $cls = \Inilim\Tool\Method\Other\clearClosure($cls);
}
