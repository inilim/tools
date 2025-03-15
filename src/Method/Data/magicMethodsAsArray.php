<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function magicMethodsAsArray()
{
    return \Inilim\Tool\Method\Data\magicMethodsAsClosure()->__invoke();
}
