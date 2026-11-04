<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function uuid($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value, $message);

    $uuid = '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}';

    if (\strpos($value, 'urn:uuid:') === 0 && \preg_match('/^urn:uuid:'.$uuid.'$/D', $value)) {
        return $value;
    }

    if (\strpos($value, 'uuid:') === 0 && \preg_match('/^uuid:(?:'.$uuid.'|\{'.$uuid.'\})$/D', $value)) {
        return $value;
    }

    if (\strpos($value, '{') === 0 && \substr($value, -1) === '}' && \preg_match('/^\{'.$uuid.'\}$/D', $value)) {
        return $value;
    }

    if (\preg_match('/^'.$uuid.'$/D', $value)) {
        return $value;
    }

    $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
    \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
        $message ?: 'Value %s is not a valid UUID.',
        \Inilim\Tool\Method\Other\valueToString($value)
    ));
}