<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 *
 * @param array $values
 * @return \RuntimeException
 */
function sprintfRuntimeException(
    string $format = '',
    array $values  = [],
    array $args    = []
): \RuntimeException {
    return \Inilim\Tool\Method\Obj\sprintfException(
        $format,
        $values,
        \RuntimeException::class,
        $args
    );
}
