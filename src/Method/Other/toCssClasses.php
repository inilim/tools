<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author laravel
 * Conditionally compile classes from an array into a CSS class list.
 */
function toCssClasses(array $array): string
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
