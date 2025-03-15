<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return int[]
 */
function numbersAsArray()
{
    return \Inilim\Tool\Method\Data\numbersAsClosure()->__invoke();
}
