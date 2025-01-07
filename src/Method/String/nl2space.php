<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('squish');

/**
 * \r\n, \n\r, \n и \r > \s
 */
function nl2space(string $str, string $replace = ' ', bool $squish = false): string
{
    $str = \str_replace(["\r\n", "\n\r", "\n", "\r"], $replace, $str);
    return $squish ? squish($str) : $str;
}
