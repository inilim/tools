<?php

namespace Inilim\Tool\Method\Data;

function symbolsAsClosure(): \Closure
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
