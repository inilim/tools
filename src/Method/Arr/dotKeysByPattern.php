<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
function dotKeysByPattern(iterable $target, string $dotPattern): array
{
    $regex = '#^' . \str_replace('\*', '[^\.]+', \preg_quote($dotPattern)) . '#';
    return \array_values(
        \array_filter(
            \Inilim\Tool\Method\Arr\dotKeys($target),
            static fn($key) => \preg_match($regex, $key),
        )
    );
}
