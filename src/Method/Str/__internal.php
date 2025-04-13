<?php

namespace Inilim\Tool\Method\Str;

/**
 * @internal Inilim\Tool\Method\Str
 * @return \Inilim\Internal\StrInternal
 */
function __internal()
{
    static $o = null;
    return $o ?? new class() {};
}
