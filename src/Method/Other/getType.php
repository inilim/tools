<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "exception" "enum" "resource" "null" "unknown type" "resource (closed)"
 * @param mixed $v
 * @return 'null'|'array'|'float'|'enum'|'exception'|'object'|'bool'|'int'|'string'|'resource'|'resource (closed)'|'unknown type'
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
                return 'exception';
            }
            return 'object';
        case 'boolean':
            return 'bool';
        case 'integer':
            return 'int';
        default:
            return $r;
    }
}
