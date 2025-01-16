<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('cyrillicAlphabetAsClosure');

/**
 * @return string[]
 */
function cyrillicAlphabetAsArray(bool $upper = false)
{
    return cyrillicAlphabetAsClosure($upper)->__invoke();
}
