<?php

namespace Inilim\Tool\Method\Str;

/**
 * @internal Inilim\Tool\Method\Str
 * @return \Inilim\Internal\StrState
 */
function __state()
{
    static $o = null;
    return $o ?? new class()
    {
        var $randomStringFactory;
    };
}
