<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * @author Inilim "Changed it a bit"
 * Filter items where the value is not null.
 * @template TValue
 * @template TKey
 * @param array<TKey,TValue> $array
 * @return TValue[]|array<TKey,TValue>
 */
function whereNotNull(array $array, bool $preserveKeys = true)
{
    $result = \array_filter($array, static fn($v) => $v !== null);
    return $preserveKeys ? $result : \array_values($result);
}
