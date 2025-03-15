<?php

namespace Inilim\Tool\Method\String;

/**
 * Make a string's first character lowercase.
 */
function lcfirst(string $string): string
{
    return \Inilim\Tool\Method\String\lower(
        \Inilim\Tool\Method\String\substr($string, 0, 1)
    ) . \Inilim\Tool\Method\String\substr($string, 1);
}
