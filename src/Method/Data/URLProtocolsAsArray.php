<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('URLProtocolsAsClosure');

function URLProtocolsAsArray(): array
{
    return Data::URLProtocolsAsClosure()->__invoke();
}
