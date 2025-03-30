<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * @author inilim
 * Results array of items from Collection or Arrayable.
 *
 * @param  mixed  $items
 * @return array<TKey, TValue>
 */
function getArrayableItems($items)
{
    $type = \gettype($items);
    if ($type === 'array') {
        /** @var mixed[] $items */
        return $items;
    } elseif ($type === 'object') {
        /** @var object $items */
        switch (true) {
            case \PHP_VERSION_ID >= 80000 && $items instanceof \WeakMap:
                throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');
            case $items instanceof \Traversable:
                return \iterator_to_array($items);
            case $items instanceof \JsonSerializable:
                return (array) $items->jsonSerialize();
            case \PHP_VERSION_ID >= 80100 && $items instanceof \UnitEnum:
                return [$items];
            case \method_exists($items, 'toArray'):
                return (array) $items->toArray();
            case \method_exists($items, 'toJson'):
                return (array) \json_decode($items->toJson(), true);
        }
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