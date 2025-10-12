<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
function htmlEntitiesAsArray()
{
    return \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()->__invoke();
}
