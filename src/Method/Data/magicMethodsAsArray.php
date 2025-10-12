<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function magicMethodsAsArray()
{
    return \Inilim\Tool\Method\Data\magicMethodsAsClosure()->__invoke();
}
