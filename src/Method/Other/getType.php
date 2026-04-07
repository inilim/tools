<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @see https://php.net/manual/en/function.gettype.php
 * 
 * @param mixed $v
 * @param bool $trueFalseAsSeparateType if true type bool as 'true'|'false'
 * @return ($trueFalseAsSeparateType is true ? 'null'|'array'|'float'|'enum'|'exception'|'object'|'true'|'false'|'int'|'string'|'resource'|'resource_closed'|'unknown_type' : 'null'|'array'|'float'|'enum'|'exception'|'object'|'bool'|'int'|'string'|'resource'|'resource_closed'|'unknown_type')
 */
function getType($v, bool $trueFalseAsSeparateType = false): string
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
            }
            if ($v instanceof \Throwable) {
                return 'exception';
            }
            return 'object';
        case 'boolean':
            if ($trueFalseAsSeparateType) {
                return $v === true ? 'true' : 'false';
            }
            return 'bool';
        case 'integer':
            return 'int';
        case 'resource (closed)':
            return 'resource_closed';
        case 'unknown type':
            return 'unknown_type';
        default:
            return $r;
    }
}
