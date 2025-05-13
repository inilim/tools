<?php

class ArrClassic
{
    /**
     * @todo check PR _set()
     * @author laravel
     * Set an array item to a given value using "dot" notation.
     * If no key is given to the method, the entire array will be replaced.
     * @return \Closure(array &$array, string|int|null $key, mixed $value):array
     */
    static function set(array &$array, $key, $value): array
    {
        /**
         * @var string|int|null $key
         * @var mixed $value
         */
        if ($key === null) {
            return $array = $value;
        }

        $keys = \explode('.', (string)$key);

        foreach ($keys as $i => $key) {
            if (\sizeof($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) || !\is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[\array_shift($keys)] = $value;

        return $array;
    }

    /**
     * @author Laravel
     * Add an element to an array using "dot" notation if it doesn't exist.
     * @template T of array
     * @param T $array
     * @param mixed $value
     * @return T
     */
    static function add(array $array, string $key, $value)
    {
        if (self::get($array, $key) === null) {
            self::set($array, $key, $value);
        }

        return $array;
    }

    /**
     * @author Laravel
     * Determine whether the given value is array accessible.
     * @param mixed $value
     */
    static function accessible($value): bool
    {
        return \is_array($value) || $value instanceof \ArrayAccess;
    }

    /**
     * @author Laravel
     * Get an item from an array using "dot" notation.
     * @template D
     *
     * @param \ArrayAccess|array $array
     * @param string|int|null $key
     * @param D $default
     * @return mixed|D
     */
    static function get($array, $key, $default = null)
    {
        if (!self::accessible($array)) {
            return self::value($default);
        }

        if ($key === null) {
            return $array;
        }

        if (self::exists($array, $key)) {
            return $array[$key];
        }

        if (\strpos(\strval($key), '.') === false) {
            return $array[$key] ?? self::value($default);
        }

        foreach (\explode('.', \strval($key)) as $segment) {
            if (self::accessible($array) && self::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return self::value($default);
            }
        }

        return $array;
    }

    /**
     * @author laravel
     * Return the default value of the given value.
     *
     * @template TValue
     * @template TArgs
     *
     * @param  TValue|\Closure(TArgs): TValue  $value
     * @param  TArgs  ...$args
     * @return TValue
     */
    static function value($value, ...$args)
    {
        return $value instanceof \Closure ? $value(...$args) : $value;
    }

    /**
     * @author Laravel
     * Determine if the given key exists in the provided array.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|int $key
     */
    static function exists($array, $key): bool
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return \array_key_exists($key, $array);
    }

    /**
     * Run a map over each of the items in the array.
     * @template TValue
     * @template TKey
     * @template TReturn
     * @param array<TKey,TValue> $array
     * @param callable(TValue,TKey):TReturn $callback
     * @return TReturn[]
     */
    static function map(array $array, callable $callback): array
    {
        $keys = \array_keys($array);

        try {
            $items = \array_map($callback, $array, $keys);
        } catch (\ArgumentCountError $e) {
            $items = \array_map($callback, $array);
        }

        return \array_combine($keys, $items);
    }

    /**
     * Run an associative map over each of the items.
     * The callback should return an associative array with a single key/value pair.
     * @template TKey
     * @template TValue
     * @template TMapWithKeysKey of array-key
     * @template TMapWithKeysValue
     *
     * @param  array<TKey, TValue>  $array
     * @param  callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue>  $callback
     * @return array
     */
    static function mapWithKeys(array $array, callable $callback): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $assoc = $callback($value, $key);

            foreach ($assoc as $map_key => $map_value) {
                $result[$map_key] = $map_value;
            }
        }

        return $result;
    }

    /**
     * Filter the array using the given callback. array_filter
     * @template TValue
     * @template TKey
     * @param  callable(TValue,TKey)  $callback
     * @param  array<TKey,TValue>  $array
     * @return TValue[]|array<TKey,TValue>
     */
    static function where(array $array, callable $callback, bool $preserveKeys = true): array
    {
        $result = \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
        return $preserveKeys ? $result : \array_values($result);
    }

    /**
     * @author inilim
     */
    static function compareValues(array $a, array $b, array ...$arrays): bool
    {
        $arrays[] = $a;
        $arrays[] = $b;
        $arrays = \array_map(
            static fn($array) => \md5(\serialize($array)),
            self::sortRecursive(self::resetKeysRecursive($arrays))
        );
        return \sizeof(self::unique($arrays)) === 1;
    }

    /**
     * Recursively sort an array by keys and values.
     */
    static function sortRecursive(array $array, int $options = \SORT_REGULAR, bool $descending = false): array
    {
        foreach ($array as &$value) {
            if (\is_array($value)) {
                $value = self::sortRecursive($value, $options, $descending);
            }
        }

        if (self::isAssoc($array)) {
            $descending
                ? \krsort($array, $options)
                : \ksort($array, $options);
        } else {
            $descending
                ? \rsort($array, $options)
                : \sort($array, $options);
        }

        return $array;
    }

    /**
     * Determines if an array is associative.
     * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
     */
    static function isAssoc(array $array): bool
    {
        $keys = \array_keys($array);
        return \array_keys($keys) !== $keys;
    }

    /**
     * @author inilim
     * @return array
     */
    static function resetKeysRecursive(array $array)
    {
        $array = \array_values($array);
        foreach ($array as $idx => $value) {
            $array[$idx] = \is_array($value) ? self::resetKeysRecursive($value) : $value;
        }
        return $array;
    }

    /**
     * @template TValue
     * @param TValue[] $array
     * @return TValue[]
     */
    static function unique(array $array): array
    {
        return \array_keys(\array_flip($array));
    }
}
