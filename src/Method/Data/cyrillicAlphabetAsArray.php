<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('cyrillicAlphabetAsClosure');

function cyrillicAlphabetAsArray(bool $upper = false): array
{
    return Data::cyrillicAlphabetAsClosure($upper)->__invoke();
}
