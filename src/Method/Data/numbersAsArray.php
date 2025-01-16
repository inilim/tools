<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('numbersAsClosure');

/**
 * @return int[]
 */
function numbersAsArray()
{
    return numbersAsClosure()->__invoke();
}
