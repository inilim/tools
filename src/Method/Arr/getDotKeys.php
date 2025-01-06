<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('dot');

/**
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
function getDotKeys(array $target, string $dotPattern): array
{
    $pattern = '#^' . \str_replace('\*', '[^\.]+', \preg_quote($dotPattern)) . '#';
    return \array_values(
        \array_filter(
            \array_keys(\Inilim\Tool\Method\Arr\dot($target)),
            static fn($key) => \preg_match($pattern, $key),
        )
    );
}
