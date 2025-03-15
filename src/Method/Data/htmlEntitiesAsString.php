<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
function htmlEntitiesAsString(string $separator = ',')
{
    return \implode($separator, \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()->__invoke());
}
