<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Conditionally compile styles from an array into a style list.
 *
 * @param  array|string  $array
 * @return string
 */
function toCssStyles($array)
{
    $styleList = \Inilim\Tool\Method\LarArr\wrap($array);

    $styles = [];

    foreach ($styleList as $class => $constraint) {
        if (\is_numeric($class)) {
            $styles[] = \Inilim\Tool\Method\LarStr\finish($constraint, ';');
        } elseif ($constraint) {
            $styles[] = \Inilim\Tool\Method\LarStr\finish($class, ';');
        }
    }

    return \implode(' ', $styles);
}
