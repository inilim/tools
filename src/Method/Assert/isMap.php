<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T
 * @psalm-assert array<string, T> $array
 * @phpstan-assert array<string, T> $array
 *
 * @param mixed $array
 * @param string|callable():string $message
 *
 * @return array
 *
 * @throws \InvalidArgumentException
 */
function isMap($array, $message = ''): array
{
    \Inilim\Tool\Method\Assert\isArray($array, $message);

    if (\count($array) > 0 && \Inilim\Tool\Method\Check\isList($array)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(
            $message ?: 'Expected map - associative array with string keys.'
        );
    }

    return $array;
}