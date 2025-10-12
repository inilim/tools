<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Conditionally compile classes from an array into a CSS class list.
 *
 * @param  array|string  $array
 * @return string
 */
function toCssClasses($array)
{
    $classList = \Inilim\Tool\Method\LarArr\wrap($array);

    $classes = [];

    foreach ($classList as $class => $constraint) {
        if (\is_numeric($class)) {
            $classes[] = $constraint;
        } elseif ($constraint) {
            $classes[] = $class;
        }
    }

    return \implode(' ', $classes);
}
