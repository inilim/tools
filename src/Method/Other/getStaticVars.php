<?php

namespace Inilim\Tool\Method\Other;

/**
 * @skip_build
 *
 * @param string $class
 * @return array
 */
function getStaticVars(string $class): array
{
    $result = [];
    foreach (\get_class_vars($class) as $name => $default) {
        $result[$name] = $class::$$name ?? $default;
    }
    return $result;
}
