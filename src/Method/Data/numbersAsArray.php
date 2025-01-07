<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('numbersAsClosure');

function numbersAsArray(): string
{
    return numbersAsClosure()->__invoke();
}
