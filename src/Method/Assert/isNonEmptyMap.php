<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T
 * @psalm-assert array<string, T> $array
 * @psalm-assert !empty $array
 * @phpstan-assert array<string, T> $array
 * @phpstan-assert !empty $array
 *
 * @param mixed $array
 * @param string|callable():string $message
 *
 * @return array
 *
 * @throws \InvalidArgumentException
 */
function isNonEmptyMap($array, $message = ''): array
{
    \Inilim\Tool\Method\Assert\isMap($array, $message);
    \Inilim\Tool\Method\Assert\notEmpty($array, $message);

    return $array;
}