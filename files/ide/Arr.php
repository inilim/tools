<?php

namespace Inilim\Tool;

class Arr
{
        /**
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param mixed $value
 * @return T
 */
    static function add(array $array, string $key, $value) {}

        /**
 * Collapse an array of arrays into a single array.
 * @param  iterable  $array
 * @return array
 */
    static function collapse(iterable $array) {}

        /**
 * @return bool
 */
    static function compareValues(array $a, array $b, array ...$arrays) {}

        /**
 * Cross join the given arrays, returning all possible permutations.
 * @param iterable ...$arrays
 * @return array
 */
    static function crossJoin(...$arrays) {}

        /**
 * Get an item from an array or object using "dot" notation.
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
 * @return mixed
 */
    static function dataGet($target, $key, $default = null) {}

        /**
 * alternate dataGet
 *
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
 * @return mixed
 */
    static function dataGetV2($target, $key, $default = null) {}

        /**
 * Divide an array into two arrays. One with keys and the other with values.
 * @template K
 * @template V
 * @param array<K,V> $array
 * @return array{K[],V[]}
 */
    static function divide(array $array) {}

        /**
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
    static function dotKeys(iterable $array, string $prepend = '') {}

        /**
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
    static function dotKeysByPattern(iterable $target, string $dotPattern) {}

        /**
 * Execute a callback over each item.
 * @template V
 * @template K
 * @param \ArrayAccess<K,V>|array<K,V> $array
 * @param callable(V,K):mixed $callback
 * @return void
 */
    static function each($array, callable $callback) {}

        /**
 * Execute a callback over each nested chunk of items.
 * @param callable(...mixed):mixed $callback
 * @return void
 */
    static function eachSpread(array $array, callable $callback) {}

        /**
 * Get all of the given array except for a specified array of keys.
 * @template T of array
 * @param T $array
 * @param  (string|int)[]|string|int $keys
 * @return T
 */
    static function except(array $array, $keys) {}

        /**
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
    static function exceptNestedArray(array $array, $keys, int $depth = 1) {}

        /**
 * Flatten a multi-dimensional array into a single level.
 * @return array
 */
    static function flatten(iterable $array, int $depth) {}

        /**
 * Determine if any of the keys exist in an array using "dot" notation.
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|int|string|null  $keys
 * @return bool
 */
    static function hasAny($array, $keys) {}

        /**
 * @param mixed[]|mixed $values
 * @return bool
 */
    static function hasValue(array $array, $values, bool $strict = false) {}

        /**
 * @param mixed[]|mixed $values
 * @return bool
 */
    static function hasValueAny(array $array, $values, bool $strict = false) {}

        /**
 * Get the first element of an array. Useful for method chaining.
 * @template TValue of mixed
 * @param array<TValue> $array
 * @return TValue|false
 */
    static function head(array $array) {}

        /**
 * Determines if an array is associative.
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 * @return bool
 */
    static function isAssoc(array $array) {}

        /**
 * @return bool
 */
    static function isList(array $array) {}

        /**
 * проверка на многомерный массив
 * true - многомерный
 * false - одномерный
 * @return bool
 */
    static function isMultidimensional(array $array) {}

        /**
 * Join all items using a string. The final items can use a separate glue string.
 */
    static function join(array $array, string $glue, string $finalGlue = ''): string {}

        /**
 * @template T of array
 * @param T $array
 * @return T
 */
    static function keysLower(array $array) {}

        
    static function keysLowerNestedArray(array $array, int $depth = 1): array {}

        /**
 * @template T of array
 * @param T $array
 * @return T
 */
    static function keysUpper(array $array) {}

        
    static function keysUpperNestedArray(array $array, int $depth = 1): array {}

        /**
 * Get the last element from an array.
 * @template TValue of mixed
 * @param array<TValue> $array
 * @return TValue|false
 */
    static function last(array $array) {}

        /**
 * Run a map over each of the items in the array.
 * @template TValue
 * @template TKey
 * @template TReturn
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey):TReturn $callback
 * @return TReturn[]
 */
    static function map(array $array, callable $callback): array {}

        /**
 * @template TValue of mixed
 * @template TKey of int|string
 * @template TOffset of int
 * @param mixed $filteringValue
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey,TOffset):mixed $callback
 */
    static function mapFilter(array $array, callable $callback, $filteringValue = null, bool $preserveKeys = false): array {}

        /**
 * Run a grouping map over the items.
 * The callback should return an associative array with a single key/value pair.
 * @template TValue
 * @template TKey
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey) $callback
 */
    static function mapToGroups(array $array, callable $callback): array {}

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
    static function mapWithKeys(array $array, callable $callback): array {}

        /**
 * Get a subset of the items from the given array.
 * @param  (string|int)[]|string|int  $keys
 */
    static function only(array $array, $keys): array {}

        /**
 * @param  (string|int)[]|string|int $keys
 */
    static function onlyNestedArray(array $array, $keys, int $depth = 1): array {}

        /**
 * Pluck an array of values from an array.
 * @param  string|array|int|null  $value
 * @param  string|string[]|null  $key
 */
    static function pluck(iterable $array, $value, $key = null): array {}

        /**
 * Push an item onto the beginning of an array.
 * @param  array  $array
 * @param  mixed  $value
 * @param  mixed  $key
 */
    static function prepend(array $array, $value, $key = null): array {}

        /**
 * Prepend the key names of an associative array.
 */
    static function prependKeysWith(array $array, string $prepend_with): array {}

        /**
 * Convert the array into a query string.
 */
    static function query(array $array): string {}

        /**
 * Get one or a specified number of random values from an array.
 * @template TValue
 * @template TKey
 * @param  array<TKey,TValue>  $array
 * @param  int|null  $number
 * @param  bool  $preserve_keys
 *
 * @return TValue|TValue[]|array<TKey,TValue>
 *
 * @throws \InvalidArgumentException
 */
    static function random(array $array, ?int $number = null, bool $preserveKeys = false) {}

        /**
 * @return array
 */
    static function resetKeysRecursive(array $array) {}

        /**
 * Shuffle the given array and return the result.
 * @param mixed[] $array
 * @return mixed[]
 */
    static function shuffle(array $array, ?int $seed = null, bool $preserveKeys = true) {}

        /**
 * @template T of (mixed[]|object)[]
 * @param T $arr
 * @return T
 */
    static function sortBy(array $arr, string $by, int $options = \SORT_REGULAR, bool $descending = false): array {}

        /**
 * Recursively sort an array by keys and values.
 */
    static function sortRecursive(array $array, int $options = \SORT_REGULAR, bool $descending = true): array {}

        /**
 * Recursively sort an array by keys and values in descending order.
 */
    static function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array {}

        /**
 * @template V of mixed
 * @template K of int|string
 *
 * @param array<K,V> $array
 * @return array<int,array<K,V>>
 */
    static function splitIntoChunks(array $array, int $chunks, bool $preserveKeys = false, bool $removeEmptyChunks = false) {}

        /**
 * Take the first or last {$limit} items from an array.
 * @template TArray
 * @param TArray $array
 * @return TArray
 */
    static function take(array $array, int $limit) {}

        /**
 * @template TValue
 * @param TValue[] $array
 * @return TValue[]
 */
    static function unique(array $array): array {}

        /**
 * Filter the array using the given callback. array_filter
 * @template TValue
 * @template TKey
 * @param  callable(TValue,TKey)  $callback
 * @param  array<TKey,TValue>  $array
 * @return TValue[]|array<TKey,TValue>
 */
    static function where(array $array, callable $callback, bool $preserve_keys = true): array {}

        /**
 * If the given value is not an array, wrap it in one.
 * @param mixed $value
 */
    static function wrap($value): array {}

    }