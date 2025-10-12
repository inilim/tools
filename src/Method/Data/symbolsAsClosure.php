<?php

declare(strict_types=1);

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
