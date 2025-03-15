<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert a string to kebab case.
 */
function kebab(string $value): string
{
    return \Inilim\Tool\Method\String\snake($value, '-');
}
