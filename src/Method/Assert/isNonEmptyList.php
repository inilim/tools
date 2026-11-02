<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @psalm-pure
 *
 * @psalm-assert non-empty-list<mixed> $array
 *
 * @param string|callable():string $message
 *
 * @return non-empty-list<mixed>
 *
 * @throws \InvalidArgumentException
 */
function isNonEmptyList($array, $message = ''): array
{
    \Inilim\Tool\Method\Assert\isList($array, $message);
    \Inilim\Tool\Method\Assert\notEmpty($array, $message);

    return $array;
}
