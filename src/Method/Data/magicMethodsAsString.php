<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function magicMethodsAsString(string $separator = '')
{
    return \implode($separator, \Inilim\Tool\Method\Data\magicMethodsAsClosure()->__invoke());
}
