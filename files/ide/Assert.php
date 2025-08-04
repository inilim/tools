<?php

namespace Inilim\Tool;

class Assert
{
        /**
 * @author webmozarts/assert
 * @psalm-assert class-string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function classExists($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function directory($value, string $message = '') {}

        /**
 * @author Inilim
 * @param mixed $value
 * @return void
 * @throws \InvalidArgumentException
 */
    static function enumCase($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function file($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert float $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function float($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * Does strict comparison, so Assert::inArray(3, ['3']) does not pass the assertion.
 * @psalm-pure
 * @param mixed  $value
 * @param array  $values
 * @throws \InvalidArgumentException
 */
    static function inArray($value, array $values, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function integer($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function integerish($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param object|string $value
 * @param string[]      $classes
 * @throws \InvalidArgumentException
 */
    static function isAnyOf($value, array $classes, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function isCallable($value, string $message = '') {}

        /**
 * @psalm-pure
 * @psalm-assert countable $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function isCountable($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-template ExpectedType of object
 * @psalm-param class-string<ExpectedType> $class
 * @psalm-assert ExpectedType $value
 * @param mixed         $value
 * @param string|object $class
 * @throws \InvalidArgumentException
 */
    static function isInstanceOf($value, $class, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param mixed                $value
 * @param array<object|string> $classes
 * @throws \InvalidArgumentException
 */
    static function isInstanceOfAny($value, array $classes, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string $value
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function json($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert positive-int|0 $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function natural($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @param mixed  $value
 * @param mixed  $expect
 * @throws \InvalidArgumentException
 */
    static function notEq($value, $expect, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function numeric($value, string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * @return void
 * @throws \AssertionError
 */
    static function php80(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * @return void
 * @throws \AssertionError
 */
    static function php81(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * @param string $message
 * @return void
 * @throws \AssertionError
 */
    static function php82($message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * @param string $message
 * @return void
 * @throws \AssertionError
 */
    static function php83($message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * @param string $message
 * @return void
 * @throws \AssertionError
 */
    static function php84($message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert positive-int $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function positiveInteger($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function string($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert non-empty-string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function stringNotEmpty($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @psalm-assert array-key $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function validArrayKey($value, string $message = '') {}

    }