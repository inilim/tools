<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author webmozarts/assert
 * @param mixed $value
 */
function valueToString($value): string
{
    if (null === $value) {
        return 'null';
    }

    if (true === $value) {
        return 'true';
    }

    if (false === $value) {
        return 'false';
    }

    if (\is_array($value)) {
        return 'array';
    }

    if (\is_object($value)) {
        if (\method_exists($value, '__toString')) {
            return \get_class($value) . ': ' . \Inilim\Tool\Method\Other\valueToString($value->__toString());
        }

        if ($value instanceof \DateTime || $value instanceof \DateTimeImmutable) {
            return \get_class($value) . ': ' . \Inilim\Tool\Method\Other\valueToString($value->format('c'));
        }

        if (\Inilim\Tool\Method\Other\funcPhp('enum_exists') && \enum_exists(\get_class($value))) {
            return \get_class($value) . '::' . $value->name;
        }

        return \get_class($value);
    }

    if (\is_resource($value)) {
        return 'resource';
    }

    if (\is_string($value)) {
        return '"' . $value . '"';
    }

    return (string) $value;
}
