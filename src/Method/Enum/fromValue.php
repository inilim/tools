<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 * @return T
 * @throws \Exception
 */
function fromValue($enum, $value, bool $caseInsensitive = false)
{
    $case = \Inilim\Tool\Method\Enum\tryFromValue($enum, $value, $caseInsensitive);
    if ($case === null) {
        throw new \Exception(\sprintf(
            '"%s" is not a valid backing value for enum "%s"',
            $value,
            \is_string($enum) ? $enum : \get_class($enum)
        ));
    }

    return $case;
}
