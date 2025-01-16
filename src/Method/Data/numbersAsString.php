<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('numbersAsClosure');

/**
 * @return string
 */
function numbersAsString(string $separator = "")
{
    return \implode($separator, numbersAsClosure()->__invoke());
}
