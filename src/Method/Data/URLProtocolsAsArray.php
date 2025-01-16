<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('URLProtocolsAsClosure');

/**
 * @return string[]
 */
function URLProtocolsAsArray()
{
    return URLProtocolsAsClosure()->__invoke();
}
