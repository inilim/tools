<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return string[]
 */
function URLProtocolsAsArray()
{
    return \Inilim\Tool\Method\Data\URLProtocolsAsClosure()->__invoke();
}
