<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('latinAlphabetAsClosure');

/**
 * @return string
 */
function latinAlphabetAsString(string $separator = "", bool $upper = false)
{
    return \implode($separator, latinAlphabetAsClosure($upper)->__invoke());
}
