<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('cyrillicAlphabetAsClosure');

function cyrillicAlphabetAsString(string $separator = "", bool $upper = false): string
{
    return \implode($separator, cyrillicAlphabetAsClosure($upper)->__invoke());
}
