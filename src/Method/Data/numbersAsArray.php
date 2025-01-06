<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('numbersAsClosure');

function numbersAsArray(): string
{
    return Data::numbersAsClosure()->__invoke();
}
