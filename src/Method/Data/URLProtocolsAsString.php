<?php

namespace Inilim\Data\Method;

use Inilim\Tool\Data;

Data::__include('URLProtocolsAsClosure');

function URLProtocolsAsString(string $separator = ""): string
{
    return \implode($separator, Data::URLProtocolsAsClosure()->__invoke());
}
