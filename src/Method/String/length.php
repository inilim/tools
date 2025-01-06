<?php

namespace Inilim\Tool\Method\String;

/**
 * Return the length of the given string.
 * @param string|null $encoding
 * @return int
 */
function length(string $value, $encoding = 'UTF-8')
{
    return \mb_strlen($value, $encoding);
}
