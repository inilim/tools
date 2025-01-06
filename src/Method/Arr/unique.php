<?php

namespace Inilim\Method\Arr;

/**
 * @template TValue
 * @param TValue[] $array
 * @return TValue[]
 */
function unique(array $array): array
{
    return \array_keys(\array_flip($array));
}
