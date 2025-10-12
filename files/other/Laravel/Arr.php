<?php

namespace Illuminate\Support;

use ArgumentCountError;
use ArrayAccess;
use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use JsonSerializable;
use Random\Randomizer;
use Traversable;
use WeakMap;

class Arr
{
    use Macroable;

    /**
     * Get the underlying array of items from the given argument.
     *
     * @template TKey of array-key = array-key
     * @template TValue = mixed
     *
     * @param  array<TKey, TValue>|Enumerable<TKey, TValue>|Arrayable<TKey, TValue>|WeakMap<object, TValue>|Traversable<TKey, TValue>|Jsonable|JsonSerializable|object  $items
     * @return ($items is WeakMap ? list<TValue> : array<TKey, TValue>)
     *
     * @throws \InvalidArgumentException
     */
    public static function from($items)
    {
        return match (true) {
            is_array($items) => $items,
            $items instanceof Enumerable => $items->all(),
            $items instanceof Arrayable => $items->toArray(),
            $items instanceof WeakMap => iterator_to_array($items, false),
            $items instanceof Traversable => iterator_to_array($items),
            $items instanceof Jsonable => json_decode($items->toJson(), true),
            $items instanceof JsonSerializable => (array) $items->jsonSerialize(),
            is_object($items) => (array) $items,
            default => throw new InvalidArgumentException('Items cannot be represented by a scalar value.'),
        };
    }

    /**
     * Key an associative array by a field or using a callback.
     *
     * @param  iterable  $array
     * @param  callable|array|string  $keyBy
     * @return array
     */
    public static function keyBy($array, $keyBy)
    {
        return (new Collection($array))->keyBy($keyBy)->all();
    }

    /**
     * Explode the "value" and "key" arguments passed to "pluck".
     *
     * @param  string|array|Closure  $value
     * @param  string|array|Closure|null  $key
     * @return array
     */
    protected static function explodePluckParameters($value, $key)
    {
        $value = is_string($value) ? explode('.', $value) : $value;

        $key = is_null($key) || is_array($key) || $key instanceof Closure ? $key : explode('.', $key);

        return [$value, $key];
    }

    /**
     * Get one or a specified number of random values from an array.
     *
     * @param  array  $array
     * @param  int|null  $number
     * @param  bool  $preserveKeys
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public static function random($array, $number = null, $preserveKeys = false)
    {
        $requested = is_null($number) ? 1 : $number;

        $count = count($array);

        if ($requested > $count) {
            throw new InvalidArgumentException(
                "You requested {$requested} items, but there are only {$count} items available."
            );
        }

        if (empty($array) || (! is_null($number) && $number <= 0)) {
            return is_null($number) ? null : [];
        }

        $keys = (new Randomizer)->pickArrayKeys($array, $requested);

        if (is_null($number)) {
            return $array[$keys[0]];
        }

        $results = [];

        if ($preserveKeys) {
            foreach ($keys as $key) {
                $results[$key] = $array[$key];
            }
        } else {
            foreach ($keys as $key) {
                $results[] = $array[$key];
            }
        }

        return $results;
    }





    /**
     * Shuffle the given array and return the result.
     *
     * @param  array  $array
     * @return array
     */
    public static function shuffle($array)
    {
        return (new Randomizer)->shuffleArray($array);
    }



    /**
     * Sort the array using the given callback or "dot" notation.
     *
     * @param  iterable  $array
     * @param  callable|array|string|null  $callback
     * @return array
     */
    public static function sort($array, $callback = null)
    {
        return (new Collection($array))->sortBy($callback)->all();
    }

    /**
     * Sort the array in descending order using the given callback or "dot" notation.
     *
     * @param  iterable  $array
     * @param  callable|array|string|null  $callback
     * @return array
     */
    public static function sortDesc($array, $callback = null)
    {
        return (new Collection($array))->sortByDesc($callback)->all();
    }
}