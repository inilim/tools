<?php

namespace Inilim\Tool;

class Lar
{
        /**
 * Fill in data where it's missing.
 *
 * @return \Closure(mixed $target, string|array $key, mixed $value):mixed
 */
    static function dataFill(): Closure {}

        /**
 * Remove / unset an item from an array or object using "dot" notation.
 * @return \Closure(mixed $target, string|array|int|null $key):mixed
 */
    static function dataForget(): Closure {}

        /**
 * Get an item from an array or object using "dot" notation.
 *
 * @param  mixed  $target
 * @param  string|array|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
    static function dataGet($target, $key, $default = null) {}

        /**
 * Set an item on an array or object using dot notation.
 *
 * @return \Closure(mixed $target, string|array $key, mixed $value, bool $overwrite = true):mixed
 */
    static function dataSet(): Closure {}

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
    static function value($value, ...$args) {}

    }