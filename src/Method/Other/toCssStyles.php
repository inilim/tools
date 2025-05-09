<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Laravel
 * Conditionally compile styles from an array into a style list.
 */
function toCssStyles(array $array): string
{
    $styles = [];

    foreach ($array as $class => &$constraint) {
        if (\is_numeric($class)) {
            $styles[] = \Inilim\Tool\Method\Str\finish($constraint, ';');
        } elseif ($constraint) {
            $styles[] = \Inilim\Tool\Method\Str\finish($class, ';');
        }
    }

    return \implode(' ', $styles);
}
