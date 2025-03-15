<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function magicMethodsAsString(string $separator = '')
{
    return \implode($separator, \Inilim\Tool\Method\Data\magicMethodsAsClosure()->__invoke());
}
