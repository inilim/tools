<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function numbersAsString(string $separator = '')
{
    return \implode($separator, \Inilim\Tool\Method\Data\numbersAsClosure()->__invoke());
}
