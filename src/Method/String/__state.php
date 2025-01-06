<?php

namespace Inilim\Tool\Method\String;

/**
 * @internal Inilim\Tool\Method\String
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
