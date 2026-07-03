<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * @author inilim
 * Results array of items from Collection or Arrayable.
 *
 * @param  mixed  $items
 * @return array<TKey, TValue>
 */
function getArrayableItems($items): array
{
    if ($items === null) {
        return [];
    } elseif (\is_scalar($items) || (\Inilim\Tool\Method\Check\php81() && $items instanceof \UnitEnum)) {
        return \Inilim\Tool\Method\LarArr\wrap($items);
    }
    return \Inilim\Tool\Method\Arr\from($items);
}
