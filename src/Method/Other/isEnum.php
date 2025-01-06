<?php

namespace Inilim\Method\Other;

function isEnum($value): bool
{
    if (PHP_VERSION_ID < 80100) return false;

    if (\is_object($value)) {
        return $value instanceof \UnitEnum;
    } elseif (\is_string($value)) {
        return \enum_exists($value);
    }
    return false;
}
