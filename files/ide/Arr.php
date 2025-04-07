<?php

namespace Inilim\Tool;

class Arr
{
        /**
 * @author Laravel
 * Determine whether the given value is array accessible.
 * @param mixed $value
 * @return bool
 */
    static function accessible($value) {}

        /**
 * @author Laravel
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param mixed $value
 * @return T
 */
    static function add(array $array, string $key, $value) {}

        /**
 * @author Laravel
 * Collapse an array of arrays into a single array.
 * @param  iterable  $array
 * @return array
 */
    static function collapse(iterable $array) {}

        /**
 * @author inilim
 * @return bool
 */
    static function compareValues(array $a, array $b, array ...$arrays) {}

        /**
 * @author Laravel
 * Cross join the given arrays, returning all possible permutations.
 * @param iterable ...$arrays
 * @return array
 */
    static function crossJoin(...$arrays) {}

        /**
 * @author Laravel
 * Fill in data where it's missing.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
    static function dataFill() {}

        /**
 * @author Laravel
 * Get an item from an array or object using "dot" notation.
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
 * @return mixed
 */
    static function dataGet($target, $key, $default = null) {}

        /**
 * alternate dataGet
 * @author inilim
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
 * @return mixed
 */
    static function dataGetV2($target, $key, $default = null) {}

        /**
 * @author Laravel
 * Set an item on an array or object using dot notation.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
    static function dataSet() {}

        /**
 * @author Laravel
 * Divide an array into two arrays. One with keys and the other with values.
 * @template K
 * @template V
 * @param array<K,V> $array
 * @return array{K[],V[]}
 */
    static function divide(array $array) {}

        /**
 * @author Laravel
 * Flatten a multi-dimensional associative array with dots.
 * @return array<string,mixed>
 */
    static function dot(iterable $array, string $prepend = '') {}

        /**
 * @author inilim
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
    static function dotKeys(iterable $array, string $prepend = '') {}

        /**
 * @author inilim
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
 * @author Laravel
 * Execute a callback over each nested chunk of items.
 * @param callable(...mixed):mixed $callback
 * @return void
 */
    static function eachSpread(array $array, callable $callback) {}

        /**
 * @author Laravel
 * Get all of the given array except for a specified array of keys.
 * @template T of array
 * @param T $array
 * @param (string|int)[]|string|int $keys
 * @return T
 */
    static function except(array $array, $keys) {}

        /**
 * @author inilim
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
    static function exceptNestedArray(array $array, $keys, int $depth = 1) {}

        /**
 * @author Laravel
 * Determine if the given key exists in the provided array.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int  $key
 * @return bool
 */
    static function exists($array, $key) {}

        /**
 * @author Laravel
 * Flatten a multi-dimensional array into a single level.
 * @return array
 */
    static function flatten(iterable $array, int $depth) {}

        /**
 * @author Laravel
 * Remove one or many array items from a given array using "dot" notation.
 * @return \Closure(array &$array, (string|int)[]|string|int $keys):void
 */
    static function forget() {}

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
    static function get($array, $key, $default = null) {}

        /**
 * @author Laravel
 * @author inilim
 * Results array of items from Collection or Arrayable.
 *
 * @param  mixed  $items
 * @return array<TKey, TValue>
 */
    static function getArrayableItems($items) {}

        /**
 * @author nette/utils
 * Returns zero-indexed position of given array key. Returns null if key is not found.
 * @param string|int $key
 * @return null|int
 */
    static function getKeyOffset(array $array, $key) {}

        /**
 * @author laravel
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|string|int  $keys
 * @return bool
 */
    static function has($array, $keys) {}

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
 * @template TValue
 * @param TValue[] $array
 * @return TValue|false
 */
    static function head(array $array) {}

        /**
 * @author nette/utils
 * Inserts the contents of the $inserted array into the $array before the $key.
 * If $key is null (or does not exist), it is inserted at the end.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
    static function insertAfter() {}

        /**
 * @author nette/utils
 * Inserts the contents of the $inserted array into the $array immediately after the $key.
 * If $key is null (or does not exist), it is inserted at the beginning.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
    static function insertBefore() {}

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

        /**
 * @param array $array
 * @return array
 */
    static function keysLowerNestedArray(array $array, int $depth = 1) {}

        /**
 * @template T of array
 * @param T $array
 * @return T
 */
    static function keysUpper(array $array) {}

        /**
 * @author inilim
 * @param mixed[] $array
 * @return mixed[]
 */
    static function keysUpperNestedArray(array $array, int $depth = 1) {}

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
 * @author inilim
 * @template TValue of mixed
 * @template TKey of int|string
 * @template TOffset of int
 * @param mixed $filteringValue
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey,TOffset):mixed $callback
 * @return array<TKey,TValue>
 */
    static function mapFilter(array $array, callable $callback, $filteringValue = null, bool $preserveKeys = false) {}

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
 * @author inilim
 * @param mixed[] $array
 * @param callable(array $node, int|string|null $keyNode):array $callable
 * @return mixed[]
 */
    static function nestedMap(array $array, int $depth, callable $callable) {}

        /**
 * Get a subset of the items from the given array.
 * @param  (string|int)[]|string|int  $keys
 */
    static function only(array $array, $keys): array {}

        /**
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
    static function onlyNestedArray(array $array, $keys, int $depth = 1) {}

        /**
 * @author Laravel
 * @author Inilim "Changed it a bit"
 * Partition the array into two arrays using the given callback.
 *
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<int<0, 1>, array<TKey, TValue>>
 */
    static function partition(iterable $array, callable $callback) {}

        /**
 * Pluck an array of values from an array.
 * @param  string|array|int|null  $value
 * @param  string|string[]|null  $key
 */
    static function pluck(iterable $array, $value, $key = null): array {}

        /**
 * Push an item onto the beginning of an array.
 * @param array $array
 * @param mixed $value
 * @param mixed $key
 */
    static function prepend(array $array, $value, $key = null): array {}

        /**
 * Prepend the key names of an associative array.
 */
    static function prependKeysWith(array $array, string $prepend_with): array {}

        /**
 * Get a value from the array, and remove it.
 * @return \Closure(array &$array, string|int $key, mixed $default):mixed
 */
    static function pull() {}

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
 * @return \Closure(array &$array, string $oldKey, string $newKey):bool
 */
    static function renameDotKey() {}

        /**
 * @author nette/utils
 * Renames key in array.
 * @return \Closure(array &$array, string|int $oldKey, string|int $newKey):bool
 */
    static function renameKey() {}

        /**
 * @author inilim
 * @return array
 */
    static function resetKeysRecursive(array $array) {}

        /**
 * @author Laravel
 * Select an array of values from an array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
    static function select(array $array, $keys) {}

        /**
 * Set an array item to a given value using "dot" notation.
 * If no key is given to the method, the entire array will be replaced.
 * @return \Closure(array &$array, ?string $key, mixed $value):array
 */
    static function set() {}

        /**
 * @author inilim
 * set if null OR empty string OR empty array
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
    static function setValueIfEmpty() {}

        /**
 * @author inilim
 * установить значение если значения по ключу нет
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
    static function setValueIfNotExists() {}

        /**
 * @author inilim
 * установить значение если значение по ключу null
 * @return \Closure(array &$array, string|int $key, mixed $value):bool
 */
    static function setValueIfNull() {}

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
 * @author inilim
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
 * @author nette/utils
 * Copies the elements of the $array array to the $object object and then returns it.
 * @template T of object
 * @param  T  $object
 * @return T
 */
    static function toObj(iterable $array, object $object) {}

        /**
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
    static function undot($array): array {}

        /**
 * @template TValue
 * @param TValue[] $array
 * @return TValue[]
 */
    static function unique(array $array): array {}

        /**
 * Return the default value of the given value.
 * @param  mixed $value
 * @return mixed
 */
    static function value($value) {}

        /**
 * @author inilim
 * @return \Closure(object|array &$array, callable $callable):void
 */
    static function walkRecursive() {}

        /**
 * Filter the array using the given callback. array_filter
 * @template TValue
 * @template TKey
 * @param  callable(TValue,TKey)  $callback
 * @param  array<TKey,TValue>  $array
 * @return TValue[]|array<TKey,TValue>
 */
    static function where(array $array, callable $callback, bool $preserveKeys = true): array {}

        /**
 * @author Laravel
 * @author Inilim "Changed it a bit"
 * Filter items where the value is not null.
 * @template TValue
 * @template TKey
 * @param array<TKey,TValue> $array
 * @return TValue[]|array<TKey,TValue>
 */
    static function whereNotNull(array $array, bool $preserveKeys = true) {}

        /**
 * If the given value is not an array, wrap it in one.
 * @param mixed $value
 */
    static function wrap($value): array {}

    }