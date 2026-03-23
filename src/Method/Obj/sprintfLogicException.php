<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 *
 * @param array $values
 * @return \LogicException
 */
function sprintfLogicException(
    string $format = '',
    array $values  = [],
    array $args    = []
): \LogicException {
    return \Inilim\Tool\Method\Obj\sprintfException(
        $format,
        $values,
        \LogicException::class,
        $args
    );
}
