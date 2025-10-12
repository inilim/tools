<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author laravel
 * Get the underlying array of items from the given argument.
 *
 * @template TKey of array-key = array-key
 * @template TValue = mixed
 *
 * @param  array<TKey, TValue>|\WeakMap<object, TValue>|\Traversable<TKey, TValue>|\JsonSerializable|object  $items
 * @return ($items is WeakMap ? list<TValue> : array<TKey, TValue>)
 *
 * @throws \InvalidArgumentException
 */
function from($items): array
{
    $type = \gettype($items);

    if ($type === 'array') {
        /** @var array $items */
        return $items;
    } elseif ($type === 'object') {
        /** @var object $items */
        if (false) {
        } elseif (\method_exists($items, 'toArray')) {
            return $items->toArray();
        } elseif (\method_exists($items, 'toJson')) {
            return (array) \json_decode($items->toJson(), true);
        } elseif (\Inilim\Tool\Method\Check\php80() && $items instanceof \WeakMap) {
            return \iterator_to_array($items, false);
        } elseif ($items instanceof \JsonSerializable) {
            return (array) $items->jsonSerialize();
        } elseif ($items instanceof \Traversable) {
            return \iterator_to_array($items);
        } else {
            return (array) $items;
        }
    }

    throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');
}
