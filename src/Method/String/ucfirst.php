<?php

namespace Inilim\Tool\Method\String;

/**
 * Make a string's first character uppercase.
 */
function ucfirst(string $string): string
{
    return \Inilim\Tool\Method\String\upper(
        \Inilim\Tool\Method\String\substr($string, 0, 1)
    ) . \Inilim\Tool\Method\String\substr($string, 1);
}
