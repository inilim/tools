<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $array
 * @param string|int $key
 * @param string|callable():string $message
 *
 * @return array
 *
 * @throws \InvalidArgumentException
 */
function keyNotExists($array, $key, $message = ''): array
{
    \Inilim\Tool\Method\Assert\isArray($array, $message);

    if (isset($array[$key]) || \array_key_exists($key, $array)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected the key %s to not exist.',
            \Inilim\Tool\Method\Other\valueToString($key)
        ));
    }

    return $array;
}