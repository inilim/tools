<?php

namespace Inilim\Tool\Method\Other;

/**
 * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "object exception" "enum" "resource" "null" "unknown type" "resource (closed)"
 */
function getType($value): string
{
    $r = \gettype($value);
    switch ($r) {
        case 'NULL':
            return 'null';
        case 'double':
            return 'float';
        case 'object':
            if (\PHP_VERSION_ID >= 80100 && $value instanceof \UnitEnum) {
                return 'enum';
            } elseif ($value instanceof \Throwable) {
                return 'object exception';
            }
            return 'object';
        default:
            return $r;
    }
}
