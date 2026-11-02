<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @psalm-pure
 *
 * @psalm-assert list<mixed> $array
 *
 * @param string|callable():string $message
 *
 * @return list<mixed>
 *
 * @throws \InvalidArgumentException
 */
function isList($array, $message = ''): array
{
    if (!\Inilim\Tool\Method\Check\isList($array)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(
            $message ?: 'Expected list - non-associative array.'
        );
    }

    return $array;
}
