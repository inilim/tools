<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @author webmozarts/assert
 * @param mixed $value
 */
function valueToString($value): string
{
    $type = \Inilim\Tool\Method\Other\getType($value, true);

    if ($type === 'string') {
        return '"' . $value . '"';
    }

    if (\in_array($type, ['true', 'false', 'null', 'resource', 'resource_closed', 'array'])) {
        return $type;
    }

    if (\in_array($type, ['object', 'exception'])) {
        if (\method_exists($value, '__toString')) {
            return \get_class($value) . ': ' . \Inilim\Tool\Method\Other\valueToString($value->__toString());
        }

        if ($value instanceof \DateTime || $value instanceof \DateTimeImmutable) {
            return \get_class($value) . ': ' . \Inilim\Tool\Method\Other\valueToString($value->format('c'));
        }

        return \get_class($value);
    }

    if ($type === 'enum') {
        if (\enum_exists(\get_class($value))) {
            return \get_class($value) . '::' . $value->name;
        }
        return \get_class($value);
    }

    return (string) $value;
}
