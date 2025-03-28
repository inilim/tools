<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "object exception" "enum" "resource" "null" "unknown type" "resource (closed)"
 * @param mixed $v
 * @return string
 */
function getType($v)
{
    $r = \gettype($v);
    switch ($r) {
        case 'NULL':
            return 'null';
        case 'double':
            return 'float';
        case 'object':
            if (\PHP_VERSION_ID >= 80100 && $v instanceof \UnitEnum) {
                return 'enum';
            } elseif ($v instanceof \Throwable) {
                return 'object exception';
            }
            return 'object';
        default:
            return $r;
    }
}
