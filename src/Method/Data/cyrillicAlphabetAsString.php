<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('cyrillicAlphabetAsClosure');

/**
 * @return string
 */
function cyrillicAlphabetAsString(string $separator = "", bool $upper = false)
{
    return \implode($separator, cyrillicAlphabetAsClosure($upper)->__invoke());
}
