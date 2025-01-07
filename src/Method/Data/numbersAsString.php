<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('numbersAsClosure');

function numbersAsString(string $separator = ""): string
{
    return \implode($separator, numbersAsClosure()->__invoke());
}
