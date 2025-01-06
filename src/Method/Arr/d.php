<?php

namespace Inilim\Array;

use Inilim\FuncCore\FuncCore;

class Array_
{
    /**
     * Execute a callback over each nested chunk of items.
     * @param callable(...mixed): mixed $callback
     */
    function eachSpread(array $array, callable $callback): void
    {
        $this->each($array, static function ($chunk, $key) use ($callback) {
            $chunk[] = $key;
            return $callback(...$chunk);
        });
    }

    /**
     * Execute a callback over each item.
     * @template TValue
     * @template TKey
     * @param callable(TValue,TKey): mixed $callback
     */
    function each(array $array, callable $callback): void
    {
        foreach ($array as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }
    }

    /**
     * Run a map over each nested chunk of items.
     */
    function mapSpread(array $array, callable $callback): array
    {
        return $this->map($array, static function ($chunk) use ($callback) {
            return $callback(...$chunk);
        });
    }

    /**
     * Run a grouping map over the items.
     * The callback should return an associative array with a single key/value pair.
     * @template TValue
     * @template TKey
     * @param array<TKey,TValue> $array
     * @param callable(TValue,TKey) $callback
     */
    function mapToGroups(array $array, callable $callback): array
    {
        return \array_reduce(
            $this->map($array, $callback),
            static function ($groups, $pair) {
                $groups[\key($pair)][] = \reset($pair);
                return $groups;
            }
        );
    }

    /**
     * @param mixed[]|mixed $values
     */
    function hasValueAny(array $array, $values, bool $strict = false): bool
    {
        $values = $this->wrap($values);

        if (!$array || !$values) {
            return false;
        }

        foreach ($values as $value) {
            if ($this->hasValue($array, $value, $strict)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param mixed[]|mixed $values
     */
    function hasValue(array $array, $values, bool $strict = false): bool
    {
        $values = $this->wrap($values);

        if (!$array || !$values) {
            return false;
        }

        foreach ($values as $value) {
            if (!\in_array($value, $array, $strict)) {
                return false;
            }
        }
        return true;
    }

    function keysLowerNestedArray(array $array, int $depth = 1): array
    {
        if ($depth === 0 || $depth < 0) {
            return $this->keysLower($array);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $this->keysLowerNestedArray($item, ($depth - 1));
            }
        }
        return $array;
    }

    function keysUpperNestedArray(array $array, int $depth = 1): array
    {
        if ($depth === 0 || $depth < 0) {
            return $this->keysUpper($array);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $this->keysUpperNestedArray($item, ($depth - 1));
            }
        }
        return $array;
    }

    function keysUpper(array $array): array
    {
        return \array_change_key_case($array, \CASE_UPPER);
    }

    function keysLower(array $array): array
    {
        return \array_change_key_case($array, \CASE_LOWER);
    }

    /**
     * установить значение если значения по ключу нет
     * @param mixed $value
     */
    function setValueIfNotExists(array &$array, string $key_dot, $value): bool
    {
        if (!$this->has($array, $key_dot)) {
            $this->set($array, $key_dot, $value);
            return true;
        }
        return false;
    }

    /**
     * set if null OR empty string OR empty array
     */
    function setValueIfEmpty(array &$array, string $key_dot, $value): bool
    {
        $cur = $this->get($array, $key_dot);
        if (\in_array($cur, [null, '', []], true)) {
            $this->set($array, $key_dot, $value);
            return true;
        }
        return false;
    }

    /**
     * установить значение если значение по ключу null
     * @param mixed $value
     */
    function setValueIfNull(array &$array, string $key_dot, $value): bool
    {
        if ($this->has($array, $key_dot) && $this->get($array, $key_dot) === null) {
            $this->set($array, $key_dot, $value);
            return true;
        }
        return false;
    }

    function renameDotKey(array &$array, string $old_key, string $new_key): bool
    {
        $array  = $this->dot($array);
        $result = $this->renameKey($array, $old_key, $new_key);
        $array  = $this->undot($array);
        return $result;
    }

    /**
     * @param  (string|int)[]|string|int $keys
     */
    function onlyNestedArray(array $array, $keys, int $depth = 1): array
    {
        if ($depth === 0 || $depth < 0) {
            return $this->only($array, $keys);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $this->onlyNestedArray($item, $keys, ($depth - 1));
            }
        }
        return $array;
    }

    /**
     * @param  (string|int)[]|string|int $keys
     */
    function exceptNestedArray(array $array, $keys, int $depth = 1): array
    {
        if ($depth === 0 || $depth < 0) {
            return $this->except($array, $keys);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $this->exceptNestedArray($item, $keys, ($depth - 1));
            }
        }
        return $array;
    }

    /**
     * @template TValue
     *
     * @param TValue[] $array
     * @return TValue[]
     * Remove the duplicates from an array.
     *
     * This is faster version than the builtin array_unique().
     *
     * Notes on time requirements:
     *   array_unique -> O(n log n)
     *   array_flip -> O(n)
     * @deprecated
     *
     * http://stackoverflow.com/questions/8321620/array-unique-vs-array-flip
     * http://php.net/manual/en/function.array-unique.php
     */
    function fastArrayUnique(array $array): array
    {
        return FuncCore::unique($array);
    }

    /**
     * @template TValue
     *
     * @param TValue[] $array
     * @return TValue[]
     */
    function unique(array $array): array
    {
        return FuncCore::unique($array);
    }

    /**
     * Inserts the contents of the $inserted array into the $array immediately after the $key.
     * If $key is null (or does not exist), it is inserted at the beginning.
     */
    function insertBefore(array &$array, string|int|null $key, array $inserted): void
    {
        $offset = $key === null ? 0 : (int) $this->getKeyOffset($array, $key);
        $array = \array_slice($array, 0, $offset, true)
            + $inserted
            + \array_slice($array, $offset, \sizeof($array), true);
    }

    /**
     * Inserts the contents of the $inserted array into the $array before the $key.
     * If $key is null (or does not exist), it is inserted at the end.
     */
    function insertAfter(array &$array, string|int|null $key, array $inserted): void
    {
        if ($key === null || ($offset = $this->getKeyOffset($array, $key)) === null) {
            $offset = \sizeof($array) - 1;
        }

        $array = \array_slice($array, 0, $offset + 1, true)
            + $inserted
            + \array_slice($array, $offset + 1, \sizeof($array), true);
    }

    /**
     * Renames key in array.
     */
    function renameKey(array &$array, string|int $old_key, string|int $new_key): bool
    {
        $offset = $this->getKeyOffset($array, $old_key);
        if ($offset === null) {
            return false;
        }

        $val = &$array[$old_key];
        $keys = \array_keys($array);
        $keys[$offset] = $new_key;
        $array = \array_combine($keys, $array);
        $array[$new_key] = &$val;
        return true;
    }

    /**
     * Returns zero-indexed position of given array key. Returns null if key is not found.
     */
    function getKeyOffset(array $array, string|int $key): ?int
    {
        $value = \array_search(\key([$key => null]), \array_keys($array), true);
        return $value === false ? null : $value;
    }

    /**
     * проверка на многомерный массив
     * true - многомерный
     * false - одномерный
     */
    function isMultidimensional(array $arr): bool
    {
        return (\sizeof($arr) - \sizeof($arr, \COUNT_RECURSIVE)) !== 0;
    }

    /**
     * @template TArray of array
     * @param TArray $arr
     * @return TArray
     */
    function sortBy(array $arr, string $by, int $options = \SORT_REGULAR, bool $descending = false): array
    {
        $t = [];
        foreach ($arr as $key => $value) {
            $t[$key] = $this->dataGet($value, $by);
        }

        $descending ? \arsort($t, $options) : \asort($t, $options);

        foreach (\array_keys($t) as $key) {
            $t[$key] = $arr[$key];
        }

        return $t;
    }





    /**
     * Add an element to an array using "dot" notation if it doesn't exist.
     *
     * @param  array  $array
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return array
     */
    function add(array $array, string $key, $value): array
    {
        if ($this->get($array, $key) === null) {
            $this->set($array, $key, $value);
        }

        return $array;
    }

    /**
     * Collapse an array of arrays into a single array.
     *
     * @param  iterable  $array
     */
    function collapse(iterable $array): array
    {
        $results = [];

        foreach ($array as $values) {
            if (!\is_array($values)) {
                continue;
            }

            $results[] = $values;
        }

        return \array_merge([], ...$results);
    }

    /**
     * Cross join the given arrays, returning all possible permutations.
     *
     * @param  iterable  ...$arrays
     */
    function crossJoin(...$arrays): array
    {
        $results = [[]];

        foreach ($arrays as $index => $array) {
            $append = [];

            foreach ($results as $product) {
                foreach ($array as $item) {
                    $product[$index] = $item;

                    $append[] = $product;
                }
            }

            $results = $append;
        }

        return $results;
    }

    /**
     * @template T
     * @template K
     *
     * @param array<K,T> $array
     * @return array<int,array<K,T>>
     */
    function splitIntoChunks(array $array, int $chunks, bool $preserve_keys = false, bool $remove_empty_chunks = false): array
    {
        if (!$array || $chunks === 0) return [];
        // return \array_chunk($array, \ceil(\sizeof($array) / \abs($chunks)), $preserve_keys);

        $i = 0;
        $result = \array_fill(0, \abs($chunks), []);
        foreach ($array as $key => $value) {

            if ($preserve_keys) $result[$i][$key] = $value;
            else $result[$i][] = $value;

            $i++;

            if (!isset($result[$i])) $i = 0;
        }

        if ($remove_empty_chunks) {
            $result = \array_filter($result, null);
        }

        return $result;
    }

    /**
     * Join all items using a string. The final items can use a separate glue string.
     */
    function join(array $array, string $glue, string $final_glue = ''): string
    {
        if ($final_glue === '') return \implode($glue, $array);

        if (!$array) return '';
        if (\sizeof($array) === 1) return \end($array);

        $finalItem = \array_pop($array);

        return \implode($glue, $array) . $final_glue . $finalItem;
    }

    /**
     * Convert the array into a query string.
     */
    function query(array $array): string
    {
        return \http_build_query($array, '', '&', \PHP_QUERY_RFC3986);
    }

    /**
     * Prepend the key names of an associative array.
     */
    function prependKeysWith(array $array, string $prepend_with): array
    {
        return $this->mapWithKeys($array, static fn($item, $key) => [$prepend_with . $key => $item]);
    }

    /**
     * Run an associative map over each of the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @template TKey
     * @template TValue
     * @template TMapWithKeysKey of array-key
     * @template TMapWithKeysValue
     *
     * @param  array<TKey, TValue>  $array
     * @param  callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue>  $callback
     * @return array
     */
    function mapWithKeys(array $array, callable $callback): array
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
     * Run a map over each of the items in the array.
     *
     * @template TValue
     * @template TKey
     * @template TReturn
     * @param array<TKey,TValue> $array
     * @param callable(TValue,TKey):TReturn $callback
     * @return TReturn[]
     */
    function map(array $array, callable $callback): array
    {
        $keys = \array_keys($array);

        try {
            $items = \array_map($callback, $array, $keys);
        } catch (\ArgumentCountError) {
            $items = \array_map($callback, $array);
        }

        return \array_combine($keys, $items);
    }

    /**
     * Divide an array into two arrays. One with keys and the other with values.
     */
    function divide(array $array): array
    {
        return [\array_keys($array), \array_values($array)];
    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     */
    function dot(iterable $array, string $prepend = ''): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (\is_array($value) && !empty($value)) {
                $results = \array_merge($results, $this->dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    /**
     * Get all of the given array except for a specified array of keys.
     * @param  (string|int)[]|string|int $keys
     */
    function except(array $array, $keys): array
    {
        $this->forget($array, $keys);

        return $array;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|int  $key
     */
    function exists($array, $key): bool
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return \array_key_exists($key, $array);
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     */
    function flatten(iterable $array, int $depth): array
    {
        $result = [];

        foreach ($array as $item) {
            if (!\is_array($item)) {
                $result[] = $item;
            } else {
                $values = $depth === 1
                    ? \array_values($item)
                    : $this->flatten($item, $depth - 1);

                foreach ($values as $value) {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * Remove one or many array items from a given array using "dot" notation.
     * @param  (string|int)[]|string|int  $keys
     */
    function forget(array &$array, $keys): void
    {
        $original = &$array;

        $keys = (array) $keys;

        if (!$keys) return;

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if ($this->exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = \explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (\sizeof($parts) > 1) {
                $part = \array_shift($parts);

                if (isset($array[$part]) && \is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[\array_shift($parts)]);
        }
    }

    /**
     * Get an item from an array using "dot" notation.
     * @template D
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|int|null  $key
     * @param  D  $default
     *
     * @return mixed|D
     */
    function get($array, $key, $default = null)
    {
        if (!$this->accessible($array)) {
            return $this->value($default);
        }

        if ($key === null) {
            return $array;
        }

        if ($this->exists($array, $key)) {
            return $array[$key];
        }

        if (\strpos(\strval($key), '.') === false) {
            return $array[$key] ?? $this->value($default);
        }

        foreach (\explode('.', \strval($key)) as $segment) {
            if ($this->accessible($array) && $this->exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return $this->value($default);
            }
        }

        return $array;
    }

    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  (string|int)[]|string|int  $keys
     */
    function has($array, $keys): bool
    {
        $keys = (array) $keys;

        if (!$array || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if ($this->exists($array, $key)) {
                continue;
            }

            foreach (\explode('.', $key) as $segment) {
                if ($this->accessible($subKeyArray) && $this->exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Determine if any of the keys exist in an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  (string|int)[]|int|string|null  $keys
     */
    function hasAny($array, $keys): bool
    {
        if ($keys === null) {
            return false;
        }

        $keys = (array) $keys;

        if (!$array) {
            return false;
        }

        if ($keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            if ($this->has($array, $key)) {
                return true;
            }
        }

        return false;
    }



    /**
     * Get a subset of the items from the given array.
     * @param  (string|int)[]|string|int  $keys
     */
    function only(array $array, $keys): array
    {
        return \array_intersect_key($array, \array_flip((array) $keys));
    }

    /**
     * Pluck an array of values from an array.
     *
     * @param  string|array|int|null  $value
     * @param  string|string[]|null  $key
     */
    function pluck(iterable $array, $value, $key = null): array
    {
        $results = [];

        $value = \is_string($value) ? \explode('.', $value) : $value;

        $key = $key === null || \is_array($key) ? $key : \explode('.', $key);

        foreach ($array as $item) {
            $itemValue = $this->dataGet($item, $value);

            // If the key is "null", we will just append the value to the array and keep
            // looping. Otherwise we will key the array using the value of the key we
            // received from the developer. Then we'll return the final array form.
            if ($key === null) {
                $results[] = $itemValue;
            } else {
                $itemKey = $this->dataGet($item, $key);

                if (\is_object($itemKey) && \method_exists($itemKey, '__toString')) {
                    $itemKey = (string) $itemKey;
                }

                $results[$itemKey] = $itemValue;
            }
        }

        return $results;
    }

    /**
     * Push an item onto the beginning of an array.
     *
     * @param  array  $array
     * @param  mixed  $value
     * @param  mixed  $key
     */
    function prepend(array $array, $value, $key = null): array
    {
        if (\func_num_args() === 2) {
            \array_unshift($array, $value);
        } else {
            $array = [$key => $value] + $array;
        }

        return $array;
    }

    /**
     * Get a value from the array, and remove it.
     *
     * @param  string|int  $key
     * @param  mixed  $default
     * @return mixed
     */
    function pull(array &$array, $key, $default = null)
    {
        $value = $this->get($array, $key, $default);

        $this->forget($array, $key);

        return $value;
    }

    /**
     * Get one or a specified number of random values from an array.
     * @template TValue
     * @template TKey
     * @param  array<TKey,TValue>  $array
     * @param  int|null  $number
     * @param  bool  $preserve_keys
     *
     * @return TValue|TValue[]|array<TKey,TValue>|array{}
     *
     * @throws \InvalidArgumentException
     */
    function random(array $array, ?int $number = null, bool $preserve_keys = false)
    {
        $requested = $number === null ? 1 : $number;

        $count = \sizeof($array);

        if ($requested > $count) {
            throw new \InvalidArgumentException(
                "You requested {$requested} items, but there are only {$count} items available."
            );
        }

        if ($number === null) {
            return $array[\array_rand($array)];
        }

        if ((int) $number === 0) {
            return [];
        }

        $keys = \array_rand($array, $number);

        $results = [];

        if ($preserve_keys) {
            foreach ((array) $keys as $key) {
                $results[$key] = $array[$key];
            }
        } else {
            foreach ((array) $keys as $key) {
                $results[] = $array[$key];
            }
        }

        return $results;
    }

    /**
     * Set an array item to a given value using "dot" notation.
     * If no key is given to the method, the entire array will be replaced.
     * @param  mixed  $value
     */
    function set(array &$array, ?string $key, $value): array
    {
        if ($key === null) {
            return $array = $value;
        }

        $keys = \explode('.', $key);

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
     * Shuffle the given array and return the result.
     */
    function shuffle(array $array, ?int $seed = null): array
    {
        if ($seed === null) {
            \shuffle($array);
        } else {
            \mt_srand($seed);
            \shuffle($array);
            \mt_srand();
        }

        return $array;
    }

    /**
     * Take the first or last {$limit} items from an array.
     * @template TArray
     * @param TArray $array
     * @return TArray
     */
    function take(array $array, int $limit): array
    {
        if ($limit < 0) {
            return \array_slice($array, $limit, \abs($limit));
        }

        return \array_slice($array, 0, $limit);
    }

    /**
     * Convert a flatten "dot" notation array into an expanded array.
     * @param  iterable  $array
     */
    function undot($array): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            $this->set($results, $key, $value);
        }

        return $results;
    }



    /**
     * Recursively sort an array by keys and values in descending order.
     */
    function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array
    {
        return $this->sortRecursive($array, $options, true);
    }

    /**
     * Filter the array using the given callback. array_filter
     * @template TValue
     * @template TKey
     * @param  callable(TValue,TKey)  $callback
     * @param  array<TKey,TValue>  $array
     * @return TValue[]|array<TKey,TValue>
     */
    function where(array $array, callable $callback, bool $preserve_keys = true): array
    {
        $result = \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
        return $preserve_keys ? $result : \array_values($result);
    }

    /**
     * If the given value is not an array, wrap it in one.
     * @param  mixed  $value
     */
    function wrap($value): array
    {
        return \is_array($value) ? $value : [$value];
    }

    /**
     * Fill in data where it's missing.
     *
     * @param  mixed  $target
     * @param  string|string[]  $key
     * @param  mixed  $value
     * @return mixed
     */
    function dataFill(&$target, $key, $value)
    {
        return $this->dataSet($target, $key, $value, false);
    }

    /**
     * alternate dataGet
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function dataGet2($target, $key, $default = null)
    {
        if ($key === null) {
            return $target;
        }

        if (\is_array($key) || \is_int($key) || !\str_contains($key, '*')) {
            return $this->dataGet($target, $key, $default);
        }

        $keys = $this->getDotKeys($target, $key);

        if (!$keys) {
            return $default;
        }

        return $this->dataGet(
            $this->undot($this->only($this->dot($target), $keys)),
            $key,
            $default
        );
    }

    /**
     * получаем ключи dot notation по паттерну | 
     * key.*.key....
     * @return array{}|string[]
     */
    function getDotKeys(array $target, string $dot_pattern): array
    {
        $pattern = '#^' . \str_replace('\*', '[^\.]+', \preg_quote($dot_pattern)) . '#';
        return \array_values(
            \array_filter(
                \array_keys($this->dot($target)),
                static fn($key) => \preg_match($pattern, $key),
            )
        );
    }


    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function dataGet($target, $key, $default = null)
    {
        if ($key === null) {
            return $target;
        }

        $key = \is_array($key) ? $key : \explode('.', $key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if ($segment === null) {
                return $target;
            }

            if ($segment === '*') {
                if (!\is_array($target)) {
                    return $default;
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = $this->dataGet($item, $key);
                }

                return \in_array('*', $key) ? $this->collapse($result) : $result;
            }

            if ($this->accessible($target) && $this->exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (\is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return $default;
            }
        }

        return $target;
    }

    /**
     * Set an item on an array or object using dot notation.
     *
     * @param  mixed  $target
     * @param  string|string[]  $key
     * @param  mixed  $value
     *
     * @return mixed
     */
    function dataSet(&$target, $key, $value, bool $overwrite = true)
    {
        $segments = \is_array($key) ? $key : \explode('.', $key);

        if (($segment = \array_shift($segments)) === '*') {
            if (!$this->accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    $this->dataSet($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif ($this->accessible($target)) {
            if ($segments) {
                if (!$this->exists($target, $segment)) {
                    $target[$segment] = [];
                }

                $this->dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !$this->exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (\is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                $this->dataSet($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                $this->dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }

    function isList(array $array): bool
    {
        return \array_is_list($array);
    }

    /**
     * Get the first element of an array. Useful for method chaining.
     * @template TValue
     * @param array<TValue> $array
     * @return TValue|false
     */
    function head(array $array)
    {
        return \reset($array);
    }

    /**
     * Get the last element from an array.
     * @template TValue
     * @param array<TValue> $array
     * @return TValue|false
     */
    function last(array $array)
    {
        return \end($array);
    }
}
