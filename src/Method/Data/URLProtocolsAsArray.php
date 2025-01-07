<?php

namespace Inilim\Tool\Method\Data;

\Inilim\Tool\Data::__include('URLProtocolsAsClosure');

function URLProtocolsAsArray(): array
{
    return URLProtocolsAsClosure()->__invoke();
}
