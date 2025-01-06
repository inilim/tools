<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('numbersAsClosure');

function numbersAsString(string $separator = ""): string
{
    return \implode($separator, Data::numbersAsClosure()->__invoke());
}
