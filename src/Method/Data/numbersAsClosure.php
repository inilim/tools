<?php

namespace Inilim\Tool\Method\Data;

function numbersAsClosure(): \Closure
{
    return static fn() => [
        0,
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
    ];
}
