<?php

namespace Inilim\Tool;

class Enum
{
        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T[]
 * @throws \InvalidArgumentException
 */
    static function cases($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
    static function count($enum): int {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|string|int
 */
    static function firstValue($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T
 * @throws \Exception
 */
    static function fromName($enum, string $name, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 * @return T
 * @throws \Exception
 */
    static function fromValue($enum, $value, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
    static function hasName($enum, string $name, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 */
    static function hasValue($enum, $value, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
    static function hasValues($enum): bool {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T
 */
    static function head($enum) {}

        /**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum[] $haystack
 */
    static function in(object $enum, array $haystack): bool {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
    static function intValues($enum): bool {}

        /**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum $needle
 */
    static function is(object $enum, object $needle): bool {}

        /**
 * @author Inilim
 * @deprecated use Check::enumCase
 * @template T of mixed
 * @psalm-assert-if-true \UnitEnum $value
 * @phpstan-assert-if-true \UnitEnum $value
 * 
 * @param T $v
 */
    static function isCase($v): bool {}

        /**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum $needle
 */
    static function isNot(object $enum, object $needle): bool {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T
 */
    static function last($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|string|int
 */
    static function lastValue($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return string[]
 */
    static function names($enum): array {}

        /**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum[] $haystack
 */
    static function notIn(object $enum, array $haystack): bool {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return string[]|array<string,string|int>
 */
    static function options($enum): array {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
    static function strValues($enum): bool {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return ?T
 */
    static function tryFromName($enum, string $name, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \BackedEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 * @return ?T
 */
    static function tryFromValue($enum, $value, bool $caseInsensitive = false) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|('int'|'string')
 */
    static function typeValues($enum): ?string {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return string[]|int[]
 */
    static function values($enum): array {}

    }