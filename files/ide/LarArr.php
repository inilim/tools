<?php

namespace Inilim\Tool;

class LarArr
{
        /**
 * Get an array item from an array using "dot" notation.
 *
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @return array
 *
 * @throws \InvalidArgumentException
 */
    static function _array($array, $key, ?array $default = null) {}

        /**
 * Determine whether the given value is array accessible.
 *
 * @param  mixed  $value
 */
    static function accessible($value): bool {}

        /**
 * Add an element to an array using "dot" notation if it doesn't exist.
 *
 * @param  array  $array
 * @param  string|int|float  $key
 * @param  mixed  $value
 * @return array
 */
    static function add($array, $key, $value) {}

        /**
 * Determine whether the given value is arrayable.
 * @param  mixed  $value
 * @return bool
 */
    static function arrayable($value) {}

        /**
 * Get a boolean item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 *
 * @throws \InvalidArgumentException
 */
    static function boolean($array, $key, ?bool $default = null): bool {}

        /**
 * Collapse an array of arrays into a single array.
 *
 * @param  iterable  $array
 * @return array
 */
    static function collapse($array) {}

        /**
 * Cross join the given arrays, returning all possible permutations.
 *
 * @template TValue
 *
 * @param  iterable<TValue>  ...$arrays
 * @return array<int, array<array-key, TValue>>
 */
    static function crossJoin(...$arrays) {}

        /**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @return array{TKey[], TValue[]}
 */
    static function divide($array) {}

        /**
 * Flatten a multi-dimensional associative array with dots.
 *
 * @param  iterable  $array
 * @param  string  $prepend
 * @return array
 */
    static function dot($array, $prepend = '') {}

        /**
 * Determine if all items pass the given truth test.
 *
 * @param  iterable  $array
 * @param  (callable(mixed, array-key): bool)  $callback
 * @return bool
 */
    static function every($array, callable $callback) {}

        /**
 * Get all of the given array except for a specified array of keys.
 *
 * @param  array  $array
 * @param  array|string|int|float  $keys
 * @return array
 */
    static function except($array, $keys) {}

        /**
 * Get all of the given array except for a specified array of values.
 *
 * @param  array  $array
 * @param  mixed  $values
 * @param  bool  $strict
 * @return array
 */
    static function exceptValues($array, $values, $strict = false) {}

        /**
 * Determine if the given key exists in the provided array.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|float  $key
 * @return bool
 */
    static function exists($array, $key) {}

        /**
 * Return the first element in an array passing a given truth test.
 *
 * @template TKey
 * @template TValue
 * @template TFirstDefault
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
 * @return TValue|TFirstDefault
 */
    static function first($array, ?callable $callback = null, $default = null) {}

        /**
 * Flatten a multi-dimensional array into a single level.
 *
 * @param  iterable  $array
 * @param  int  $depth
 * @return array
 */
    static function flatten($array, $depth = \INF) {}

        /**
 * Get a float item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function float($array, $key, ?float $default = null): float {}

        /**
 * Remove one or many array items from a given array using "dot" notation.
 *
 * @return \Closure(array $array,array|string|int|float $keys)
 */
    static function forget(): Closure {}

        /**
 * Get the underlying array of items from the given argument.
 *
 * @template TKey of array-key = array-key
 * @template TValue = mixed
 *
 * @param  array<TKey, TValue>|\WeakMap<object, TValue>|\Traversable<TKey, TValue>|\JsonSerializable|object  $items
 * @return ($items is \WeakMap ? list<TValue> : array<TKey, TValue>)
 *
 * @throws \InvalidArgumentException
 */
    static function from($items) {}

        /**
 * Get an item from an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
    static function get($array, $key, $default = null) {}

        /**
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
    static function has($array, $keys) {}

        /**
 * Determine if all keys exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
    static function hasAll($array, $keys) {}

        /**
 * Determine if any of the keys exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
    static function hasAny($array, $keys) {}

        /**
 * Get an integer item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function integer($array, $key, ?int $default = null): int {}

        /**
 * Determines if an array is associative.
 *
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 *
 * @param  array  $array
 * @return ($array is list ? false : true)
 */
    static function isAssoc(array $array) {}

        /**
 * Determines if an array is a list.
 *
 * An array is a "list" if all array keys are sequential integers starting from 0 with no gaps in between.
 *
 * @param  array  $array
 * @return ($array is list ? true : false)
 */
    static function isList($array) {}

        /**
 * Join all items using a string. The final items can use a separate glue string.
 *
 * @param  array  $array
 * @param  string  $glue
 * @param  string  $finalGlue
 * @return string
 */
    static function join($array, $glue, $finalGlue = '') {}

        /**
 * Return the last element in an array passing a given truth test.
 *
 * @template TKey
 * @template TValue
 * @template TLastDefault
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TLastDefault|(\Closure(): TLastDefault)  $default
 * @return TValue|TLastDefault
 */
    static function last($array, ?callable $callback = null, $default = null) {}

        /**
 * Run a map over each of the items in the array.
 *
 * @param  array  $array
 * @param  callable  $callback
 * @return array
 */
    static function map(array $array, callable $callback) {}

        /**
 * Run a map over each nested chunk of items.
 *
 * @template TKey
 * @template TValue
 *
 * @param  array<TKey, array>  $array
 * @param  callable(mixed...): TValue  $callback
 * @return array<TKey, TValue>
 */
    static function mapSpread(array $array, callable $callback) {}

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
    static function mapWithKeys(array $array, callable $callback) {}

        /**
 * Get a subset of the items from the given array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
    static function only($array, $keys) {}

        /**
 * Get a subset of the items from the given array by value.
 *
 * @param  array  $array
 * @param  mixed  $values
 * @param  bool  $strict
 * @return array
 */
    static function onlyValues($array, $values, $strict = false) {}

        /**
 * Partition the array into two arrays using the given callback.
 *
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<int<0, 1>, array<TKey, TValue>>
 */
    static function partition($array, callable $callback) {}

        /**
 * Pluck an array of values from an array.
 *
 * @param  iterable  $array
 * @param  string|array|int|\Closure|null  $value
 * @param  string|array|\Closure|null  $key
 * @return array
 */
    static function pluck($array, $value, $key = null) {}

        /**
 * Push an item onto the beginning of an array.
 *
 * @param  array  $array
 * @param  mixed  $value
 * @param  mixed  $key
 * @return array
 */
    static function prepend($array, $value, $key = null) {}

        /**
 * Prepend the key names of an associative array.
 *
 * @param array $array
 * @param string $prependWith
 * @return array
 */
    static function prependKeysWith($array, $prependWith) {}

        /**
 * Get a value from the array, and remove it.
 *
 * @return \Closure(array $array,string|int $key, mixed $default = null):mixed
 */
    static function pull(): Closure {}

        /**
 * Push an item into an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|null  $key
 * @param  mixed  $values
 * @return \Closure(ArrayAccess|array &$array, string|int|null $key, mixed ...$values):array
 */
    static function push(): Closure {}

        /**
 * Convert the array into a query string.
 *
 * @param  array  $array
 * @return string
 */
    static function query($array) {}

        /**
 * Filter the array using the negation of the given callback.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<TKey, TValue>
 */
    static function reject($array, callable $callback) {}

        /**
 * Select an array of values from an array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
    static function select($array, $keys) {}

        /**
 * Set an array item to a given value using "dot" notation.
 *
 * If no key is given to the method, the entire array will be replaced.
 *
 * @return \Closure(array $array, string|int|null $key, mixed $value):array
 */
    static function set(): Closure {}

        /**
 * Get the first item in the array, but only if exactly one item exists. Otherwise, throw an exception.
 *
 * @param  array  $array
 * @param  (callable(mixed, array-key): array)|null  $callback
 *
 * @throws \InvalidArgumentException
 */
    static function sole($array, ?callable $callback = null) {}

        /**
 * Determine if some items pass the given truth test.
 *
 * @param  iterable  $array
 * @param  (callable(mixed, array-key): bool)  $callback
 * @return bool
 */
    static function some($array, callable $callback) {}

        /**
 * Recursively sort an array by keys and values.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  int-mask-of<SORT_REGULAR|SORT_NUMERIC|SORT_STRING|SORT_LOCALE_STRING|SORT_NATURAL|SORT_FLAG_CASE>  $options
 * @param  bool  $descending
 * @return array<TKey, TValue>
 */
    static function sortRecursive($array, $options = \SORT_REGULAR, $descending = false) {}

        /**
 * Recursively sort an array by keys and values in descending order.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  int-mask-of<SORT_REGULAR|SORT_NUMERIC|SORT_STRING|SORT_LOCALE_STRING|SORT_NATURAL|SORT_FLAG_CASE>  $options
 * @param  int  $options
 * @return array<TKey, TValue>
 */
    static function sortRecursiveDesc($array, $options = \SORT_REGULAR) {}

        /**
 * Get a string item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function string($array, $key, ?string $default = null): string {}

        /**
 * Take the first or last {$limit} items from an array.
 *
 * @param  array  $array
 * @param  int  $limit
 * @return array
 */
    static function take($array, $limit) {}

        /**
 * Conditionally compile classes from an array into a CSS class list.
 *
 * @param  array<string, bool>|array<int, string|int>|string  $array
 * @return ($array is array<string, false> ? '' : ($array is '' ? '' : ($array is array{} ? '' : non-empty-string)))
 */
    static function toCssClasses($array) {}

        /**
 * Conditionally compile styles from an array into a style list.
 *
 * @param  array<string, bool>|array<int, string|int>|string  $array
 * @return ($array is array<string, false> ? '' : ($array is '' ? '' : ($array is array{} ? '' : non-empty-string)))
 */
    static function toCssStyles($array) {}

        /**
 * Convert a flatten "dot" notation array into an expanded array.
 *
 * @param  iterable  $array
 * @return array
 */
    static function undot($array) {}

        /**
 * Filter the array using the given callback.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<TKey, TValue>
 */
    static function where($array, callable $callback) {}

        /**
 * Filter items where the value is not null.
 *
 * @param  array  $array
 * @return array
 */
    static function whereNotNull($array) {}

        /**
 * If the given value is not an array and not null, wrap it in one.
 * 
 * @template TKey of array-key = array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>|TValue|null  $value
 * @return ($value is null ? array{} : ($value is array ? array<TKey, TValue> : array{TValue}))
 */
    static function wrap($value) {}

    }