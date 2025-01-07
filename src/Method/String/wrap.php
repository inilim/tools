<?php

namespace Inilim\Tool\Method\String;

/**
 * Wrap the string with the given strings.
 */
function wrap(string $value, string $before, ?string $after = null): string
{
    return $before . $value . ($after ??= $before);
}
