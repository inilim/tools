<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('magicMethodsAsClosure');

/**
 * @return string
 */
function magicMethodsAsString(string $separator = "")
{
    return \implode($separator, Data::magicMethodsAsClosure()->__invoke());
}
