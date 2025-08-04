<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string $value
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function json($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value);
    if (!\Inilim\Tool\Method\Check\isJson($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an json. Got: "%s"',
            $value
        ));
    }
}
