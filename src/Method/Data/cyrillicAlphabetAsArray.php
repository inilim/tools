<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function cyrillicAlphabetAsArray(bool $upper = false)
{
    return \Inilim\Tool\Method\Data\cyrillicAlphabetAsClosure($upper)->__invoke();
}
