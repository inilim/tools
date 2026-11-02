<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @internal
 * 
 * @psalm-pure this method is not supposed to perform side effects
 *
 * @return never
 * 
 * @throws \InvalidArgumentException
 */
function __reportInvalidArgument(string $message)
{
    throw new \InvalidArgumentException($message);
}
