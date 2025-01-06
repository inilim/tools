<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('magicMethodsAsClosure');

/**
 * @return string[]
 */
function magicMethodsAsArray()
{
    return Data::magicMethodsAsClosure()->__invoke();
}
