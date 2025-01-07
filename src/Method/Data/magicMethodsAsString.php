<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('magicMethodsAsClosure');

/**
 * @return string
 */
function magicMethodsAsString(string $separator = "")
{
    return \implode($separator, magicMethodsAsClosure()->__invoke());
}
