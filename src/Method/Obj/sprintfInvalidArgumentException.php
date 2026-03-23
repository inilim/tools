<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 *
 * @param array $values
 * @return \InvalidArgumentException
 */
function sprintfInvalidArgumentException(
    string $format = '',
    array $values  = [],
    array $args    = []
): \InvalidArgumentException {
    return \Inilim\Tool\Method\Obj\sprintfException(
        $format,
        $values,
        \InvalidArgumentException::class,
        $args
    );
}
