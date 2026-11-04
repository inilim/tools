<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @deprecated use patternRegex
 * @author inilim
 * @psalm-pure
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function regex($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\patternRegex($value, $message);
}

// TODO В webmozarts/assert тоже есть метод с таким название, и у него совершенно другое предназначение