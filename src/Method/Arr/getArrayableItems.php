<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Results array of items from Collection or Arrayable.
 *
 * @param  mixed  $items
 * @return array<TKey, TValue>
 */
function getArrayableItems($items)
{
    if (\is_array($items)) {
        return $items;
    }

    switch (true) {
        case \PHP_VERSION_ID >= 80000 && $items instanceof \WeakMap:
            throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');
        case $items instanceof \Traversable:
            return \iterator_to_array($items);
        case $items instanceof \JsonSerializable:
            return (array) $items->jsonSerialize();
        case \PHP_VERSION_ID >= 80100 && $items instanceof \UnitEnum:
            return [$items];
    }

    return (array) $items;
}


    // return match (true) {
    //         $items instanceof \WeakMap => throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.'),
    //         // $items instanceof Enumerable => $items->all(),
    //         // $items instanceof Arrayable => $items->toArray(),
    //         $items instanceof \Traversable => \iterator_to_array($items),
    //         // $items instanceof Jsonable => \json_decode($items->toJson(), true),
    //         $items instanceof JsonSerializable => (array) $items->jsonSerialize(),
    //         $items instanceof \UnitEnum => [$items],
    //         default => (array) $items,
    //     };