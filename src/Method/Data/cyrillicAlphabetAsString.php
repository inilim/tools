<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function cyrillicAlphabetAsString(string $separator = "", bool $upper = false)
{
    return \implode($separator, \Inilim\Tool\Method\Data\cyrillicAlphabetAsClosure($upper)->__invoke());
}
