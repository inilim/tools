<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function numericEntitiesAsString(string $separator = ',')
{
    return \implode($separator, \Inilim\Tool\Method\Data\numericEntitiesAsClosure()->__invoke());
}
