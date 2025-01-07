<?php

namespace Inilim\Tool\Method\String;

/**
 * Swap multiple keywords in a string with other keywords.
 */
function swap(array $map, string $subject): string
{
    return \strtr($subject, $map);
}
