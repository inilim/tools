<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function URLProtocolsAsArray()
{
    return \Inilim\Tool\Method\Data\URLProtocolsAsClosure()->__invoke();
}
