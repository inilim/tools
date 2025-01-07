<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('magicMethodsAsClosure');

/**
 * @return string[]
 */
function magicMethodsAsArray()
{
    return magicMethodsAsClosure()->__invoke();
}
