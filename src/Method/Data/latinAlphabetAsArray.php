<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('cyrillicAlphabetAsClosure');

/**
 * @return string[]
 */
function latinAlphabetAsArray(bool $upper = false)
{
    return cyrillicAlphabetAsClosure($upper)->__invoke();
}
