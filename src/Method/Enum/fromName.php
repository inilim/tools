<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T
 * @throws \Exception
 */
function fromName($enum, string $name, bool $caseInsensitive = false)
{
    $case = \Inilim\Tool\Method\Enum\tryFromName($enum, $name, $caseInsensitive);
    if ($case === null) {
        throw new \Exception(\sprintf(
            '"%s" is not a valid name for enum "%s"',
            $name,
            \is_string($enum) ? $enum : \get_class($enum)
        ));
    }

    return $case;
}
