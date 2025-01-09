<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('toStringOr');

/**
 * Replace a given value in the string sequentially with an array. |
 * 
 * $string = 'The event will take place between ? and ?'; |
 * $replaced = Str::replaceArray('?', ['8:30', '9:00'], $string); |
 *
 * @param  string[] $replace
 */
function replaceArray(string $search, array $replace, string $subject): string
{
    // if ($replace instanceof \Traversable) {
    //     $replace = collect($replace)->all();
    // }

    $segments = \explode($search, $subject);
    $result   = \array_shift($segments);

    foreach ($segments as $segment) {
        $result .= \Inilim\Tool\Method\String\toStringOr(\array_shift($replace) ?? $search, $search) . $segment;
    }

    return $result;
}
