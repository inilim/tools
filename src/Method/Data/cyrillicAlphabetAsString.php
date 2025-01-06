<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('cyrillicAlphabetAsClosure');

function cyrillicAlphabetAsString(string $separator = "", bool $upper = false): string
{
    return \implode($separator, Data::cyrillicAlphabetAsClosure($upper)->__invoke());
}
