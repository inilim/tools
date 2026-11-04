<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert array $values
 * @phpstan-assert array $values
 *
 * @param mixed $values
 * @param string|callable():string $message
 *
 * @return array
 *
 * @throws \InvalidArgumentException
 */
function uniqueValues($values, $message = ''): array
{
    \Inilim\Tool\Method\Assert\isArray($values);

    $allValues = \count($values);
    $uniqueValues = \count(\array_unique($values, \SORT_REGULAR));

    if ($allValues !== $uniqueValues) {
        $difference = $allValues - $uniqueValues;

        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an array of unique values, but %s of them %s duplicated',
            $difference,
            1 === $difference ? 'is' : 'are'
        ));
    }

    return $values;
}