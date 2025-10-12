<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function numericEntitiesAsArray()
{
    return \Inilim\Tool\Method\Data\numericEntitiesAsClosure()->__invoke();
}
