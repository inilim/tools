<?php

namespace Inilim\Tool\Method\Data;

/**
 * @return \Closure():string[]
 */
function symbolsAsClosure()
{
    return static fn() => [
        '~',
        '!',
        '#',
        '$',
        '%',
        '^',
        '&',
        '*',
        '(',
        ')',
        '-',
        '_',
        '.',
        ',',
        '<',
        '>',
        '?',
        '/',
        '\\',
        '{',
        '}',
        '[',
        ']',
        '|',
        ':',
        ';',
    ];
}
