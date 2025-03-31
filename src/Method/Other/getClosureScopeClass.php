<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @return null|class-string
 */
function getClosureScopeClass(\Closure $cls)
{
    // $print = \print_r($cls, true);
    // dde();
    $ref = new \ReflectionFunction($cls);
    $ref = $ref->getClosureScopeClass();
    if ($ref === null) {
        return null;
    }
    return $ref->getName();
}
