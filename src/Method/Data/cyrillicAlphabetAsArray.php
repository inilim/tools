<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('cyrillicAlphabetAsClosure');

function cyrillicAlphabetAsArray(bool $upper = false): array
{
    return cyrillicAlphabetAsClosure($upper)->__invoke();
}
