<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @internal
 * @return void
 * 
 * @throws \InvalidArgumentException
 */
function __notArgsHere(string $fnName, int $countArgs)
{
    if ($countArgs !== 0) {
        $fnName = \basename($fnName);
        throw new \InvalidArgumentException(\sprintf(
            '%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',
            $fnName,
            $fnName
        ));
    }
}
