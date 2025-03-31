<?php

namespace Inilim\Tool;

class Enum
{
        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T[]
 */
    static function cases($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|string|int
 */
    static function getFirstValue($enum) {}

        /**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 * @return ?T
 */
    static function tryFromValue($enum, $value, bool $caseInsensitive = false) {}

    }