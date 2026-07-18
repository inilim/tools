<?php

namespace Inilim\Tool;

class Arr
{
        /**
 * @author laravel
 * Get an array item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function _array($array, $key, ?array $default = null): array {}

        /**
 * @deprecated use LarArr::***
 * @todo to Check
 * @author Laravel
 * Determine whether the given value is array accessible.
 * @param mixed $value
 */
    static function accessible($value): bool {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param string|int|float  $key
 * @param mixed $value
 * @return T
 */
    static function add(array $array, $key, $value) {}

        /**
 * @deprecated use LarArr::***
 * Determine whether the given value is arrayable.
 * @param  mixed  $value
 */
    static function arrayable($value): bool {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Get a boolean item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function boolean($array, $key, ?bool $default = null): bool {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Collapse an array of arrays into a single array.
 */
    static function collapse(iterable $array): array {}

        /**
 * @author inilim
 */
    static function compareValues(array $a, array $b, array ...$arrays): bool {}

        /**
 * @author Laravel
 * Determine if the collection contains exactly one item. If a callback is provided, determine if exactly one item matches the condition.
 */
    static function containsOneItem(array $array, ?callable $callable = null): bool {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Cross join the given arrays, returning all possible permutations.
 * @param iterable ...$arrays
 * @return array
 */
    static function crossJoin(...$arrays) {}

        /**
 * @deprecated use Lar::***
 * @author Laravel
 * Fill in data where it's missing.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
    static function dataFill(): Closure {}

        /**
 * @deprecated use Lar::***
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
 * @deprecated use Lar::***
 * @author Laravel
 * Set an item on an array or object using dot notation.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
    static function dataSet(): Closure {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Divide an array into two arrays. One with keys and the other with values.
 * @template K
 * @template V
 * @param array<K,V> $array
 * @return array{K[],V[]}
 */
    static function divide(array $array): array {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Flatten a multi-dimensional associative array with dots.
 * @return array<string,mixed>
 */
    static function dot(iterable $array, string $prepend = '', string $separator = '.'): array {}

        /**
 * @author inilim
 * @return string[]
 */
    static function dotKeys(iterable $array, string $prepend = ''): array {}

        /**
 * @author inilim
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
    static function dotKeysByPattern(iterable $target, string $dotPattern): array {}

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
 * @deprecated use LarArr::***
 * @author Laravel
 * Get all of the given array except for a specified array of keys.
 * @template T of array
 * @param T $array
 * @param (string|int)[]|string|int $keys
 * @return T
 */
    static function except(array $array, $keys): array {}

        /**
 * @author inilim
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
    static function exceptNestedArray(array $array, $keys, int $depth = 1): array {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Determine if the given key exists in the provided array.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int $key
 */
    static function exists($array, $key): bool {}

        /**
 * @author inilim
 * @return \Closure(array &$array, int $count, mixed $value):void
 */
    static function fillByRef(): Closure {}

        /**
 * @author inilim
 * @return \Closure(array &$array, array $keys, mixed $value, bool $overwrite):void
 */
    static function fillKeysByRef(): Closure {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
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
 * @deprecated use LarArr::***
 * @author Laravel
 * Flatten a multi-dimensional array into a single level.
 * @param int $depth
 * @return array
 */
    static function flatten(iterable $array, $depth = \INF) {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Get a float item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function float($array, $key, ?float $default = null): float {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Remove one or many array items from a given array using "dot" notation.
 * @return \Closure(array &$array, (string|int)[]|string|int $keys):void
 */
    static function forget() {}

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
    static function from($items): array {}

        /**
 * @deprecated use LarArr::***
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
    static function getArrayableItems($items): array {}

        /**
 * @author nette/utils
 * Returns zero-indexed position of given array key. Returns null if key is not found.
 * @param string|int $key
 * @return null|int
 */
    static function getKeyOffset(array $array, $key) {}

        /**
 * @author nette/utils
 * 
 * Returns reference to array item. If the index does not exist, new one is created with value null.
 * @template T
 * @return \Closure(array<T>,array-key|array-key[]):?T
 * @throws \InvalidArgumentException if traversed item is not an array
 */
    static function getRef(): Closure {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|string|int  $keys
 */
    static function has($array, $keys): bool {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Determine if all keys exist in an array using "dot" notation.
 * @param  \ArrayAccess|mixed[]  $array
 * @param  string|string[]  $keys
 */
    static function hasAll($array, $keys): bool {}

        /**
 * @deprecated use LarArr::***
 * Determine if any of the keys exist in an array using "dot" notation.
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|int|string|null  $keys
 */
    static function hasAny($array, $keys): bool {}

        /**
 * @param mixed[]|mixed $values
 */
    static function hasValue(array $array, $values, bool $strict = false): bool {}

        /**
 * @param mixed[]|mixed $values
 */
    static function hasValueAny(array $array, $values, bool $strict = false): bool {}

        /**
 * @author laravel
 * Return the first element in an array passing a given truth test.
 * @template TKey
 * @template TValue
 * @template TFirstDefault
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
 * @return TValue|TFirstDefault
 */
    static function head(iterable $array, ?callable $callback = null, $default = null) {}

        /**
 * @author nette/utils
 * Inserts the contents of the $inserted array into the $array before the $key.
 * If $key is null (or does not exist), it is inserted at the end.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
    static function insertAfter(): Closure {}

        /**
 * @author nette/utils
 * Inserts the contents of the $inserted array into the $array immediately after the $key.
 * If $key is null (or does not exist), it is inserted at the beginning.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
    static function insertBefore(): Closure {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Get an integer item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function integer($array, $key, ?int $default = null): int {}

        /**
 * @deprecated use LarArr::***
 * Determines if an array is associative.
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 */
    static function isAssoc(array $array): bool {}

        /**
 * @deprecated use LarArr::***
 */
    static function isList(array $array): bool {}

        /**
 * проверка на многомерный массив
 * true - многомерный
 * false - одномерный
 */
    static function isMultidimensional(array $array): bool {}

        /**
 * @deprecated use LarArr::***
 * Join all items using a string. The final items can use a separate glue string.
 */
    static function join(array $array, string $glue, string $finalGlue = ''): string {}

        /**
 * @template T of array
 * @param T $array
 * @return T
 */
    static function keysLower(array $array): array {}

        /**
 * @param array $array
 * @return array
 */
    static function keysLowerNestedArray(array $array, int $depth = 1): array {}

        /**
 * @template T of array
 * @param T $array
 * @return T
 */
    static function keysUpper(array $array): array {}

        /**
 * @author inilim
 * @param mixed[] $array
 * @return mixed[]
 */
    static function keysUpperNestedArray(array $array, int $depth = 1): array {}

        /**
 * @author laravel
 * Return the last element in an array passing a given truth test.
 * @template TKey
 * @template TValue
 * @template TLastDefault
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TLastDefault|(\Closure(): TLastDefault)  $default
 * @return TValue|TLastDefault
 */
    static function last(iterable $array, ?callable $callback = null, $default = null) {}

        /**
 * @deprecated use LarArr::***
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
    static function mapFilter(array $array, callable $callback, $filteringValue = null, bool $preserveKeys = false): array {}

        /**
 * @deprecated use LarArr::***
 * Run a map over each nested chunk of items.
 *
 * @template TKey
 * @template TValue
 *
 * @param  array<TKey, array>  $array
 * @param  callable(mixed...): TValue  $callback
 * @return array<TKey, TValue>
 */
    static function mapSpread(array $array, callable $callback): array {}

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
 * @deprecated use LarArr::***
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
 * @see /../../tests/Method/Arr/nestedMapTest.php
 * 
 * @author inilim
 * @param mixed[] $array
 * @param callable(array $node, int|string|null $keyNode):array $callable
 * @return mixed[]
 */
    static function nestedMap(array $array, int $depth, callable $callable): array {}

        /**
 * @deprecated use LarArr::***
 * Get a subset of the items from the given array.
 * @param  (string|int)[]|string|int  $keys
 */
    static function only(array $array, $keys): array {}

        /**
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
    static function onlyNestedArray(array $array, $keys, int $depth = 1): array {}

        /**
 * @author inilim
 * @template T
 *
 * @param T $array
 * @param (string|int)[]|string|int $keys
 * @return T
 * @throws \Exception
 */
    static function onlyOrFail(array $array, $keys): array {}

        /**
 * @deprecated use LarArr::***
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
    static function partition(iterable $array, callable $callback): array {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Pluck an array of values from an array.
 * @param  string|array|int|null  $value
 * @param  string|string[]|null  $key
 */
    static function pluck(iterable $array, $value, $key = null): array {}

        /**
 * @deprecated use LarArr::***
 * Push an item onto the beginning of an array.
 * @param array $array
 * @param mixed $value
 * @param mixed $key
 */
    static function prepend(array $array, $value, $key = null): array {}

        /**
 * @deprecated use LarArr::***
 * Prepend the key names of an associative array.
 */
    static function prependKeysWith(array $array, string $prependWith): array {}

        /**
 * @deprecated use LarArr::***
 * Get a value from the array, and remove it.
 * @return \Closure(array &$array, string|int $key, mixed $default):mixed
 */
    static function pull(): Closure {}

        /**
 * @deprecated use LarArr::***
 * Convert the array into a query string.
 */
    static function query(array $array): string {}

        /**
 * Get one or a specified number of random values from an array.
 * @template TValue
 * @template TKey
 * @param  array<TKey,TValue>  $array
 * @param  int|null  $number
 * @param  bool  $preserveKeys
 *
 * @return TValue|TValue[]|array<TKey,TValue>
 *
 * @throws \InvalidArgumentException
 */
    static function random(array $array, ?int $number = null, bool $preserveKeys = false) {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Filter the array using the negation of the given callback.
 * @param  callable  $callback
 */
    static function reject(array $array, callable $callback): array {}

        /**
 * @return \Closure(array &$array, string $oldKey, string $newKey):bool
 */
    static function renameDotKey(): Closure {}

        /**
 * @author nette/utils
 * Renames key in array.
 * @return \Closure(array &$array, string|int $oldKey, string|int $newKey):bool
 */
    static function renameKey(): CLosure {}

        /**
 * @author inilim
 * @template V
 * @template K
 * @param array<K,V> $array
 * @return V[]
 */
    static function resetKeysRecursive(array $array): array {}

        /**
 * @deprecated use LarArr::***
 * @author Laravel
 * Select an array of values from an array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
    static function select(array $array, $keys) {}

        /**
 * @deprecated use LarArr::***
 * @todo check PR _set()
 * @author laravel
 * Set an array item to a given value using "dot" notation.
 * If no key is given to the method, the entire array will be replaced.
 * @return \Closure(array &$array, string|int|null $key, mixed $value):array
 */
    static function set(): Closure {}

        /**
 * @author inilim
 * set if null OR empty string OR empty array
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
    static function setValueIfEmpty(): CLosure {}

        /**
 * @author inilim
 * установить значение если значения по ключу нет
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
    static function setValueIfNotExists(): Closure {}

        /**
 * @author inilim
 * установить значение если значение по ключу null
 * @return \Closure(array &$array, string|int $key, mixed $value):bool
 */
    static function setValueIfNull(): Closure {}

        /**
 * Shuffle the given array and _return the result.
 * @param mixed[] $array
 * @return mixed[]
 */
    static function shuffle(array $array, ?int $seed = null, bool $preserveKeys = true) {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Get the first item in the collection, but only if exactly one item exists. Otherwise, throw an exception.
 *
 * @return mixed
 *
 * @throws \Exception
 */
    static function sole(array $array, ?callable $callback = null) {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * 
 * Determine if some items pass the given truth test.
 *
 * @param (callable(mixed, array-key): bool) $callback
 */
    static function some(iterable $array, callable $callback): bool {}

        /**
 * @template T of (mixed[]|object)[]
 * @param T $arr
 * @return T
 */
    static function sortBy(array $arr, string $by, int $options = \SORT_REGULAR, bool $descending = false): array {}

        /**
 * @deprecated use LarArr::***
 * Recursively sort an array by keys and values.
 */
    static function sortRecursive(array $array, int $options = \SORT_REGULAR, bool $descending = false): array {}

        /**
 * @deprecated use LarArr::***
 * Recursively sort an array by keys and values in descending order.
 */
    static function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array {}

        /**
 * @author inilim
 * @template V
 * @template K
 *
 * @param array<K,V> $array
 * @return ($preserveKeys is true ? array<int,array<K,V>> : array<int,V[]>)
 */
    static function splitIntoChunks(array $array, int $chunks, bool $preserveKeys = false, bool $removeEmptyChunks = false): array {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * Get a string item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
    static function string($array, $key, ?string $default = null): string {}

        /**
 * @author gigabites19 <https://github.com/gigabites19>
 * Swap places of items in an array.
 * @return \Closure(array &$array, string|int $keyOne, string|int $keyTwo):void
 */
    static function swap(): Closure {}

        /**
 * @deprecated use LarArr::***
 * @author laravel
 * 
 * Take the first or last {$limit} items from an array.
 * @template TArray
 * @param TArray $array
 * @return TArray
 */
    static function take(array $array, int $limit): array {}

        /**
 * @author nette/utils
 * Copies the elements of the $array array to the $object object and then returns it.
 * @template T of object
 * @param  T  $object
 * @return T
 */
    static function toObj(iterable $array, object $object) {}

        /**
 * @deprecated use LarArr::***
 * @todo check PR _undot()
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
    static function undot($array): array {}

        /**
 * @author inilim
 * @template TValue
 * @param TValue[] $array
 * @return TValue[]
 */
    static function unique(array $array): array {}

        /**
 * @deprecated use Lar::***
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
    static function value($value, ...$args) {}

        /**
 * Return all the values of an array
 * @link https://php.net/manual/en/function.array-values.php
 * @template TValue
 * @param array<int|string,TValue> $array
 * The array.
 * @return TValue[] an indexed array of values.
 */
    static function values(array $array): array {}

        /**
 * @author inilim
 * @psalm-import-type Return_walkRecursive from \TypeArr
 * 
 * @return Return_walkRecursive
 */
    static function walkRecursive(): Closure {}

        /**
 * @deprecated use LarArr::***
 * Filter the array using the given callback. array_filter
 * @template TValue
 * @template TKey
 * @param  callable(TValue,TKey)  $callback
 * @param  array<TKey,TValue>  $array
 * @return TValue[]|array<TKey,TValue>
 */
    static function where(array $array, callable $callback, bool $preserveKeys = true): array {}

        /**
 * @deprecated use LarArr::***
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
 * 
 * @template TKey of array-key = array-key
 * @template TValue
 * 
 * @author inilim
 * @param  array<TKey,TValue>|TValue  $value
 * @return ($value is array ? array<TKey, TValue> : array{TValue})
 */
    static function wrap($value): array {}

    }