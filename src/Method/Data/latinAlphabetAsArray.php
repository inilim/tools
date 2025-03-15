<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function latinAlphabetAsArray(bool $upper = false)
{
    return \Inilim\Tool\Method\Data\cyrillicAlphabetAsClosure($upper)->__invoke();
}
