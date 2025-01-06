<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('squish');

/**
 * \r\n, \n\r, \n и \r > \s
 */
function nl2space(string $str, string $replace = ' ', bool $squish = false): string
{
    $str = \str_replace(["\r\n", "\n\r", "\n", "\r"], $replace, $str);
    return $squish ? \Inilim\Method\String\squish($str) : $str;
}
