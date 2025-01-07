<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('URLProtocolsAsClosure');

function URLProtocolsAsString(string $separator = ""): string
{
    return \implode($separator, URLProtocolsAsClosure()->__invoke());
}
