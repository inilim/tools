<?php

namespace Inilim\Method\String;

/**
 * @internal Inilim\Method\String
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
