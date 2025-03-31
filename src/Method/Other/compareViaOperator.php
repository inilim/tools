<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author nette/utils
 * Compares two values in the same way that PHP does. Recognizes operators: >, >=, <, <=, =, ==, ===, !=, !==, <>
 * @param mixed $left
 * @param mixed $right
 * @return bool
 */
function compareViaOperator($left, string $operator, $right)
{
    switch ($operator) {
        case '>':
            return $left > $right;
        case '>=':
            return $left >= $right;
        case '<':
            return $left < $right;
        case '<=':
            return $left <= $right;
        case '=':
        case '==':
            return $left == $right;
        case '===':
            return $left === $right;
        case '!=':
        case '<>':
            return $left != $right;
        case '!==':
            return $left !== $right;
    }

    throw new \InvalidArgumentException("Unknown operator '$operator'");
}
