<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('latinAlphabetAsClosure');

function latinAlphabetAsString(string $separator = "", bool $upper = false): string
{
    return \implode($separator, latinAlphabetAsClosure($upper)->__invoke());
}
