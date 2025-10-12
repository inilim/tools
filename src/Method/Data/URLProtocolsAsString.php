<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

function URLProtocolsAsString(string $separator = ''): string
{
    return \implode($separator, \Inilim\Tool\Method\Data\URLProtocolsAsClosure()->__invoke());
}
