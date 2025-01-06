<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('latinAlphabetAsClosure');

function latinAlphabetAsString(string $separator = "", bool $upper = false): string
{
    return \implode($separator, Data::latinAlphabetAsClosure($upper)->__invoke());
}
