<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('URLProtocolsAsClosure');

/**
 * @return string
 */
function URLProtocolsAsString(string $separator = "")
{
    return \implode($separator, URLProtocolsAsClosure()->__invoke());
}
