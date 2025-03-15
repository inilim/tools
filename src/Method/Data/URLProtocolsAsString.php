<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string
 */
function URLProtocolsAsString(string $separator = '')
{
    return \implode($separator, \Inilim\Tool\Method\Data\URLProtocolsAsClosure()->__invoke());
}
