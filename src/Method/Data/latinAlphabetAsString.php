<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function latinAlphabetAsString(string $separator = "", bool $upper = false)
{
    return \implode($separator, \Inilim\Tool\Method\Data\latinAlphabetAsClosure($upper)->__invoke());
}
