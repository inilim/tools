<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return int[]
 */
function numbersAsArray()
{
    return \Inilim\Tool\Method\Data\numbersAsClosure()->__invoke();
}
