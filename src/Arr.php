<?php

namespace Inilim\Tool;

final class Arr extends \Inilim\Tool\LazyMethodAbstract
{
    const IDX                 = 0;
    protected const NAMESPACE = 'Inilim\Tool\Method\Arr',
        PATH_TO_DIR           = __DIR__ . '/MethodMin/Arr',
        ALIAS                 = [];

    /**
     * Fill in data where it's missing.
     * @template T of array|object
     * @param T $target
     * @param  string|string[]  $key
     * @param  mixed  $value
     * @return T
     */
    static function dataFill(&$target, $key, $value)
    {
        return self::dataSet($target, $key, $value, false);
    }

    /**
     * Set an item on an array or object using dot notation.
     * @template T of array|object
     * @param T $target
     * @param string|string[] $key
     * @param mixed $value
     * @return T
     */
    static function dataSet(&$target, $key, $value, bool $overwrite = true)
    {
        $segments = \is_array($key) ? $key : \explode('.', $key);

        if (($segment = \array_shift($segments)) === '*') {
            if (!self::accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    self::dataSet($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (self::accessible($target)) {
            if ($segments) {
                if (!self::exists($target, $segment)) {
                    $target[$segment] = [];
                }

                self::dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !self::exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (\is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                self::dataSet($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                self::dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }

    /**
     * Determine whether the given value is array accessible.
     * @param mixed $value
     * @return bool
     */
    static function accessible($value)
    {
        return \is_array($value) || $value instanceof \ArrayAccess;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|int  $key
     * @return bool
     */
    static function exists($array, $key)
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return \array_key_exists($key, $array);
    }

    /**
     * Remove one or many array items from a given array using "dot" notation.
     * @param  (string|int)[]|string|int  $keys
     * @return void
     */
    static function forget(array &$array, $keys)
    {
        $original = &$array;

        $keys = (array) $keys;

        if (!$keys) return;

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (self::exists($array, $key)) {
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
     * Inserts the contents of the $inserted array into the $array before the $key.
     * If $key is null (or does not exist), it is inserted at the end.
     * @param string|int|null $key
     * @return void
     */
    static function insertAfter(array &$array, $key, array $inserted)
    {
        if ($key === null || ($offset = self::getKeyOffset($array, $key)) === null) {
            $offset = \sizeof($array) - 1;
        }

        $array = \array_slice($array, 0, $offset + 1, true)
            + $inserted
            + \array_slice($array, $offset + 1, \sizeof($array), true);
    }

    /**
     * Returns zero-indexed position of given array key. Returns null if key is not found.
     * @param string|int $key
     * @return null|int
     */
    static function getKeyOffset(array $array, $key)
    {
        $value = \array_search(
            \key([$key => null]),
            \array_keys($array),
            true
        );
        return $value === false ? null : $value;
    }

    /**
     * Inserts the contents of the $inserted array into the $array immediately after the $key.
     * If $key is null (or does not exist), it is inserted at the beginning.
     * @param string|int|null $key
     * @return void
     */
    static function insertBefore(array &$array, $key, array $inserted)
    {
        $offset = $key === null ? 0 : (int) self::getKeyOffset($array, $key);
        $array = \array_slice($array, 0, $offset, true)
            + $inserted
            + \array_slice($array, $offset, \sizeof($array), true);
    }

    /**
     * Get a value from the array, and remove it.
     *
     * @param  string|int  $key
     * @param  mixed  $default
     * @return mixed
     */
    static function pull(array &$array, $key, $default = null)
    {
        $value = self::get($array, $key, $default);
        self::forget($array, $key);
        return $value;
    }

    /**
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
     * Return the default value of the given value.
     * @param  mixed $value
     * @return mixed
     */
    static function value($value)
    {
        return $value instanceof \Closure ? $value() : $value;
    }

    /**
     * Renames key in array.
     * @param string|int $oldKey
     * @param string|int $newKey
     * @return bool
     */
    static function renameKey(array &$array, $oldKey, $newKey)
    {
        $offset = self::getKeyOffset($array, $oldKey);
        if ($offset === null) {
            return false;
        }

        $val = &$array[$oldKey];
        $keys = \array_keys($array);
        $keys[$offset] = $newKey;
        $array = \array_combine($keys, $array);
        $array[$newKey] = &$val;
        return true;
    }

    /**
     * установить значение если значение по ключу null
     * @param string|int $key
     * @param mixed $value
     * @return bool
     */
    static function setValueIfNull(array &$array, $key, $value)
    {
        if (self::has($array, $key) && self::get($array, $key) === null) {
            self::set($array, $key, $value);
            return true;
        }
        return false;
    }

    /**
     * set if null OR empty string OR empty array
     * @return bool
     */
    static function setValueIfEmpty(array &$array, string $key, $value)
    {
        $cur = self::get($array, $key, -1);
        if (\in_array($cur, [null, '', []], true)) {
            self::set($array, $key, $value);
            return true;
        }
        return false;
    }

    /**
     * установить значение если значения по ключу нет
     * @param mixed $value
     * @return bool
     */
    static function setValueIfNotExists(array &$array, string $key, $value)
    {
        if (!self::has($array, $key)) {
            self::set($array, $key, $value);
            return true;
        }
        return false;
    }

    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  (string|int)[]|string|int  $keys
     * @return bool
     */
    static function has($array, $keys)
    {
        $keys = (array) $keys;

        if (!$array || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (self::exists($array, $key)) {
                continue;
            }

            foreach (\explode('.', $key) as $segment) {
                if (self::accessible($subKeyArray) && self::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Set an array item to a given value using "dot" notation.
     * If no key is given to the method, the entire array will be replaced.
     * @param mixed $value
     */
    static function set(array &$array, ?string $key, $value): array
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
     * @return bool
     */
    static function renameDotKey(array &$array, string $oldKey, string $newKey)
    {
        $tArr   = self::dot($array);
        $result = self::renameKey($tArr, $oldKey, $newKey);
        $array  = self::undot($tArr);
        return $result;
    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     * @return array<string,mixed>
     */
    static function dot(iterable $array, string $prepend = '')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (\is_array($value) && !empty($value)) {
                $results = \array_merge($results, self::dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    /**
     * Convert a flatten "dot" notation array into an expanded array.
     * @param iterable $array
     */
    static function undot($array): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            self::set($results, $key, $value);
        }

        return $results;
    }
}
